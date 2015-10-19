<?php

namespace block_disk_quota\usage;

class quota_manager {

    protected $spaceusage;

    function __construct() {
        // TODO: determine what collectors other than internal_space_usage should be used.
        $collectors = array(new internal_space_usage());
        $this->spaceusage = new space_usage($collectors);
    }
    public function get_total_disk_space_used() {
        return $this->spaceusage->total_used();
    }

    public function get_usage_details() {
        return $this->spaceusage->usage_details();
    }

    public function record_space_used($used, $quota) {
        global $DB;
        $rec = new \stdClass;
        $rec->timemeasured = time();
        $rec->usedgb = $used;
        $rec->quotagb = $quota;
        $DB->insert_record('block_disk_quota_measurement', $rec);
    }

    public static function get_quota_and_space_used_gb() {
        global $DB;
        $rows = $DB->get_records('block_disk_quota_measurement', null, 'id desc', '*', 0, 1);
        if (count($rows) > 0) {
            $record = array_values($rows)[0];
            $used = $record->usedgb;
        } else {
            $used = null;
        }
        $a = new \stdClass;
        $a->quota = get_config('block_disk_quota', 'quota_gb');
        $a->used = $used;
        return $a;
    }

    public function block_site_if_hard_limit_exceeded($used, $hardlimit)
    {
        global $CFG;
        $blocksite = $used >= $hardlimit;
        if ($blocksite) {
            $CFG->maintenance_message = get_string('site_blocked_maintenance_message', 'block_disk_quota');
            enable_cli_maintenance_mode();
        }
        return $blocksite;
    }

    protected function notification_users($settings) {
        if ($settings->do_email_admins) {
            // throw away the user-id keys:
            $users = array_values(get_admins());
        } else {
            $users = array();
        }

        if ($settings->email_others) {
            $others = str_replace(' ', '', $settings->email_others);
            $otherslist = explode(',', $others);
            foreach ($otherslist as $other) {
                $users[]= $this->fake_user_from_bare_email_address($other);
            }
        }
        return $users;
    }

    /**
     * Generate a $user record that's acceptable for email_to_user().
     *
     * @param string $email
     * @return \stdClass user-like record
     */
    protected function fake_user_from_bare_email_address($email) {
        $user = new \stdClass;
        foreach(get_all_user_name_fields() as $field => $ignore) {
            $user->$field = '';
        }
        $user->firstname = explode('@', $email)[0];
        $user->lastname = '.';
        $user->email = $email;
        $user->auth = 'manual';
        $user->id = -1;
        return $user;
    }

    /**
     * Send notification that the site has been blocked.
     *
     * @param $used
     * @param $settings
     */
    public function notify_site_blocked($used, $settings) {
        $this->notify_if_necessary('site_blocked', $used, $settings);
    }

    /**
     * Send notification that the site is over quoata, if a notification has not recently been sent.
     *
     * @param $used
     * @param $settings
     */
    public function notify_over_quota($used, $settings) {
        $this->notify_if_necessary('over_quota', $used, $settings);
    }

    /**
     * Send notification that the site is nearing the quota limit, if a notification has not recently been sent.
     * @param $used
     * @param $settings
     */
    public function notify_near_quota($used, $settings) {
        $this->notify_if_necessary('nearing_quota', $used, $settings);
    }

    /**
     * Sends notification if necessary.  If notification is sent, the send date
     * is recorded in the block settings.
     *
     * @param $notificationtype
     * @param $used
     * @param $settings
     */
    protected function notify_if_necessary($notificationtype, $used, $settings) {
        if ($this->notification_needs_sending($notificationtype, $settings)) {
            $this->send_notification_mails(
                $notificationtype,
                $this->notification_users($settings),
                $this->standard_mail_values($used, $settings),
                $settings
            );
            $this->mark_notification_sent($notificationtype, $settings);
        }
    }

    /**
     * Sends notification mails to users.
     *
     * The notification mails have a consistent settings / language string naming convention; that fact
     * is used to generalize the sending of mails.
     *
     * @param $mail_type
     * @param $users
     * @param $mailvalues
     * @param $settings
     */
    public function send_notification_mails($mail_type, $users, $mailvalues, $settings) {
        global $CFG;
        $noreply = \core_user::get_noreply_user();
        $subjectkey = 'mail_' . $mail_type . '_subject';
        $bodykey = 'mail_' . $mail_type . '_body';
        $subject = new \lang_string($subjectkey, 'block_disk_quota');
        foreach ($users as $user) {
            $lang = empty($user->lang) ? $CFG->lang : $user->lang;
            $mailvalues->signature = $this->mail_signature($lang, $settings);
            $body = new \lang_string($bodykey, 'block_disk_quota', $mailvalues);
            email_to_user($user, $noreply, $subject->out($lang), $body->out($lang));
        }
    }

    /**
     * Returns true if the notification should be sent.
     *
     * @param $notificationtype
     * @param $settings
     * @return bool
     */
    protected function notification_needs_sending($notificationtype, $settings) {
        if ($notificationtype == 'site_blocked') {
            return true;
        }

        $lastsentattribute = $this->notification_last_sent_attribute($notificationtype);
        if (empty($settings->$lastsentattribute)) {
            // Value has never been set
            return true;
        }

        $frequencyattribute = $this->notification_frequency_attribute($notificationtype);
        $now = time();
        $duration = intval($settings->$frequencyattribute) * 24 * 60 * 60;
        $lastsent = intval($settings->$lastsentattribute);

        return $lastsent + $duration <= $now;
    }

    protected function notification_last_sent_attribute($notificationtype) {
        return 'notification_' . $notificationtype . '_sent_date';
    }

    protected function notification_frequency_attribute($notificationtype) {
        return $notificationtype . '_warn_email_frequency';
    }

    /**
     * Marks the notification as having been sent at the current time.
     *
     * Note: this also updates the last-sent value in $settings.
     *
     * @param $notificationtype
     * @param $settings
     */
    protected function mark_notification_sent($notificationtype, $settings) {
        $lastsentattribute = $this->notification_last_sent_attribute($notificationtype);
        $settings->$lastsentattribute = time();
        set_config($lastsentattribute, $settings->$lastsentattribute, 'block_disk_quota');
    }

    protected function standard_mail_values($spaceused, $settings) {
        global $CFG;
        $a = new \stdClass;
        $a->url = $CFG->wwwroot;
        $a->used = round(floatval($spaceused), 3);
        $a->quota = $settings->quota_gb;
        return $a;
    }

    protected function mail_signature($lang, $settings) {
        $a = new \stdClass;
        $a->supportemail = $settings->support_email;
        $a->supporttelephone = $settings->support_telephone;
        $signature = new \lang_string('mail_signature', 'block_disk_quota', $a);
        return $signature->out($lang);
    }

    /**
     * For measurements that are older than 30 days, only keep one measurement per day.
     *
     * The measurement kept will be the smallest freespace measurement taken during that day. In
     * case several smallest freespace measurements are the same for a single day, only one of these
     * will be kept.
     */
    public function reduce_old_measurements() {
        global $DB;
        $thirtydaysago = time() - (60 * 60 * 24 * 30);
        $days = array();
        $records = $DB->get_records_select(
            'block_disk_quota_measurement',
            'timemeasured < ? AND historic = 0',
            array($thirtydaysago));
        if (!$records) {
            return;
        }
        foreach ($records as $id => $record) {
            $date = date('Y.m.d', $record->timemeasured);
            $freespace = $record->quotagb - $record->usedgb;
            if (!isset($days[$date]) or $days[$date][1] > $freespace) {
                $days[$date] = array($id, $freespace);
            }
        }

        // Extract the ids that should not be deleted.
        $keepids = array();
        foreach ($days as $info) {
            $keepids[]= $info[0];
        }

        // Delete all those old records but the ones that are being kept.
        $keepidslist = implode(',', $keepids);
        $DB->delete_records_select(
            'block_disk_quota_measurement',
            "timemeasured < ? AND historic = 0 AND id NOT IN ($keepidslist)",
            array($thirtydaysago, $keepidslist));

        // Set the historic flag on the kept records, so that they will not be considered again by this method:
        $DB->execute("UPDATE {block_disk_quota_measurement} set historic=1 where id in ($keepidslist)");
    }
}
