<?php

namespace block_disk_quota\usage;

class quota_manager {
    public function get_total_disk_space_used() {
        // TODO: determine what collectors other than internal_space_usage should be used.
        $collectors = array(new internal_space_usage());
        $usage = new space_usage($collectors);
        return $usage->total_used();
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
        $user->firstname = explode('@', $email)[0];
        $user->lastname = '.';
        $user->email = $email;
        $user->auth = 'manual';
        $user->id = -1;
        return $user;
    }

    public function notify_site_blocked($used, $settings) {
        global $CFG;
        $users = $this->notification_users($settings);
        $noreply = \core_user::get_noreply_user();
        $subject = new \lang_string('mail_site_blocked', 'block_disk_quota');
        $a = new \stdClass;
        $a->url = $CFG->wwwroot;
        $a->used = round(floatval($used), 3);
        $a->quota = $settings->quota_gb;
        $a->supportemail = "TODO: add support contact email to block config";
        $a->supporttelephone = "TODO: add support contact telephone to block config";
        $body = new \lang_string('mail_over_quota_body', 'block_disk_quota', $a);
        foreach ($users as $user) {
            $lang = empty($user->lang) ? $CFG->lang : $user->lang;
            email_to_user($user, $noreply, $subject->out($lang), $body->out($lang));
        }
    }

    public function notify_over_quota($used, $settings) {
        // TODO: send mail (once a day)
        // set config value with time last sent
    }

    public function notify_near_quota($used, $settings) {
        // TODO: send mail (once every 14 days or so)
        // set config value with time last sent
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
