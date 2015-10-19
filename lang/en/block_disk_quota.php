<?php
/**
 * Strings for component 'block_disk_quota', language 'en'
 *
 * @package   block_recent_activity
 * @copyright 2015 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Disk Quota';
$string['disk_quota:addinstance'] = 'Add a new Disk Quota block';
$string['disk_quota:myaddinstance'] = 'Add a new Disk Quota block to My Home (aka Dashboard)';
$string['err_cannot_uninstall_plugin'] = 'Uninstalling this plugin is not possible';
$string['quota_used'] = '{$a->used} of {$a->quota} GB used';

// Settings strings
$string['quota_gb'] = 'Disk Quota';
$string['quota_gb_desc'] = 'Disk Quota in gigabytes';
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
$string['nearing_quota_warn_email_frequency'] = 'Near quota warn frequency';
$string['nearing_quota_warn_email_frequency_desc'] = 'How often mails will be sent when the site is nearing the quota';
$string['over_quota_warn_email_frequency'] = 'Over quota warn frequency';
$string['over_quota_warn_email_frequency_desc'] = 'How often mails will be sent when the site has exceeded the quota';

// Email strings
$string['mail_nearing_quota_subject'] = 'Moodle site is nearing quota limit';
$string['mail_nearing_quota_body'] =
'Your Moodle site {$a->url} is currently using {$a->used} GB
of the allocated {$a->quota} GB space for files.

Now would be a good time to order more space, or to reduce
your space used.

If your Moodle goes too far over the disk space limit, it will
be automatically put into maintenance mode and will be unavailable
for users.

{$a->signature}
';

$string['mail_over_quota_subject'] = 'Moodle site has exceeded quota limit';
$string['mail_over_quota_body'] =
'Your Moodle site {$a->url} is currently using {$a->used} GB
of the allocated {$a->quota} GB space for files.

Please take immediate action to remedy this situation.  You can
either order more disk space for your Moodle, or reduce it\'s disk
usage.

If your Moodle goes too far over the disk space limit, it will
be automatically put into maintenance mode and will be unavailable
for users.

{$a->signature}
';

$string['mail_site_blocked_subject'] = 'Important: Moodle site has been disabled due to excessive disk usage';
$string['mail_site_blocked_body'] =
'Your Moodle site {$a->url} is currently using {$a->used} GB
of the allocated {$a->quota} GB space for files.

In order to ensure continued availability for other customers, we
have unfortunately been forced to disable your Moodle site.  This
has happened automatically, and most likely after previous warning
emails.

Please contact us immediately so that we can find a solution.

{$a->signature}
';

$string['mail_signature'] = 'With friendly greetings,
The Liip Elearning Team

Contact:
  email: {$a->supportemail}
  Telephone: {$a->supporttelephone}';
