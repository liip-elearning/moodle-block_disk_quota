<?php
// This file is part of the blocks/disk_quota Moodle plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Strings for component 'block_disk_quota', language 'en'
 *
 * @package   block_recent_activity
 * @copyright 2015 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Liip Usage Quota';
$string['disk_quota:addinstance'] = 'Add a new Disk Quota block';
$string['disk_quota:myaddinstance'] = 'Add a new Disk Quota block to My Home (aka Dashboard)';
$string['disk_quota:viewblock'] = 'View a disk quota block';
$string['disk_quota:viewusage'] = 'View disk quota details page';
$string['err_cannot_uninstall_plugin'] = 'Uninstalling this plugin is not possible';
$string['quota_used'] = '{$a->used} of {$a->quota} GB used';
$string['gigabytes_used'] = 'GB used';
$string['active_users'] = '{$a->activeusers} active users ({$a->quota} allowed)';


// Tasks.
$string['task_get_disk_usage'] = 'Get disk usage';
$string['task_send_heartbeat_email'] = 'Send a heartbeat email to check email transport';

// Settings strings.
$string['enabled'] = 'Enabled';
$string['enabled_desc'] = 'Whether the disk quota check is enforced';
$string['quota_gb'] = 'Disk Quota';
$string['quota_gb_desc'] = 'Disk Quota in gigabytes';
$string['quota_activeusers'] = 'Active users Quota';
$string['quota_activeusers_desc'] = 'Quota of active users (connected in the last 365 days)';
$string['warn_when_within_gb_of_limit'] = 'Warn when this near limit';
$string['warn_when_within_gb_of_limit_desc'] = 'Send a warning to the the defined users when the disk usage is within X gigabytes of the limit';
$string['overage_limit_gb'] = 'Allow exceeding limit by';
$string['overage_limit_gb_desc'] = 'How many gigabytes to allow exceeding the Disk Quota limit before the site is '
    .'automatically disabled.';
$string['do_email_admins'] = 'Email admins?';
$string['do_email_admins_desc'] = 'Should all admin users receive warning and site-disabled email notifications?';
$string['email_others'] = 'Additional emails';
$string['email_others_desc'] = 'Additional email addresses to use when sending out notifications. Separate multiple '
    .'addresses with a comma (e.g. user1@example.com, user2@example.org, user3@example.net)';

$string['err_invalid_email_address'] = 'The email address in position {$a} is not a valid email address';
$string['site_blocked_maintenance_message'] = 'The site is currently unavailable because the disk quota has been '
    .' largely surpassed.  Administrator: please contact support to help resolve this problem.';
$string['support_telephone'] = 'Support telephone';
$string['support_telephone_desc'] = 'Support telephone number for urgent contact';
$string['support_email'] = 'Support email';
$string['support_email_desc'] = 'Support email address';
$string['heartbeat_email'] = 'Heartbeat email';
$string['heartbeat_email_desc'] = 'Heartbeat email address; where the heartbeat email is sent';
$string['nearing_quota_warn_email_frequency'] = 'Near quota warn frequency';
$string['nearing_quota_warn_email_frequency_desc'] = 'How often mails will be sent when the site is nearing the quota';
$string['over_quota_warn_email_frequency'] = 'Over quota warn frequency';
$string['over_quota_warn_email_frequency_desc'] = 'How often mails will be sent when the site has exceeded the quota';

// Email strings.
//P.T. 16.09.2022 [MDLSAAS-39]: replaced lang-strings for the notification email (subjects + body-texts) 
$string['mail_nearing_quota_subject'] = 'Moodle site is nearing quota limit';
$string['mail_nearing_quota_body'] =
'Dear client,
This email is a kind reminder that your Moodle site is nearing the limit of its data quota.

Your Moodle site {$a->url} is currently using {$a->used} GB of the allocated {$a->quota} GB space for files.

If you need more disk space, you can contact us directly via maas@liip.ch. 10 GB extra storage space costs CHF 30,- per year.


Alternatively, we suggest that you reduce your disk usage by deleting unused data (e.g. unused files or course backups).


{$a->signature}
';

//P.T. 16.09.2022 [MDLSAAS-39]: replaced lang-strings for the notification email (subjects + body-texts)
$string['mail_over_quota_subject'] = 'Important: Moodle site has exceeded disk quota limit';
$string['mail_over_quota_body'] =
'Dear client,
This email is a kind reminder that your Moodle site has already exceeded the limit of its data quota.

Your Moodle site {$a->url} is currently using {$a->used} GB of the allocated {$a->quota} GB space for files.

Please contact us immediately to upgrade. In order to avoid automatic maintenance of your site, you may either order
more disk space, or reduce disk usage by deleting unused data immediately (e.g. unused files or course backups).


If you need more disk space, you can contact us directly via maas@liip.ch. 10 GB extra storage space costs CHF 30,- per year.


{$a->signature}
';

/***P.T. 16.09.2022 [MDLSAAS-39]: removed lang-strings for the following notification email:
$string['mail_site_blocked_subject'] = 'Important: Moodle site has been disabled due to excessive disk usage';
$string['mail_site_blocked_body'] =
*/

$string['mail_signature'] = 'With friendly greetings,
The Liip Elearning Team

Contact:
  email: {$a->supportemail}
  Telephone: {$a->supporttelephone}';
$string['mail_heartbeat_subject'] = 'Email heartbeat';
$string['mail_heartbeat_body'] = 'Email heartbeat for Moodle site URL {$a->url}';

$string['backup_filename'] = 'Filename';
$string['backup_course'] = 'Course';
$string['backup_timemodified'] = 'Last modified';
$string['backup_size'] = 'Size';
$string['backup_page_title'] = 'Backups details';
