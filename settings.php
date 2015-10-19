<?php
/**
 * Disk quota block settings
 *
 * @package    block_course_settings
 * @copyright  2015 Liip AG
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(__DIR__.'/locallib.php');

defined('MOODLE_INTERNAL') || die;


if ($ADMIN->fulltree) {
    $gb = array_merge(range(0, 9),  range(10, 300, 5));
    $gbstrings = array_map('strval', $gb);
    $gbchoices = array_combine($gbstrings, $gbstrings);

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/quota_gb',
        get_string('quota_gb', 'block_disk_quota'),
        get_string('quota_gb_desc', 'block_disk_quota'),
        '50', $gbchoices));

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/warn_when_within_gb_of_limit',
        get_string('warn_when_within_gb_of_limit', 'block_disk_quota'),
        get_string('warn_when_within_gb_of_limit_desc', 'block_disk_quota'),
        '5', $gbchoices));

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/overage_limit_gb',
        get_string('overage_limit_gb', 'block_disk_quota'),
        get_string('overage_limit_gb_desc', 'block_disk_quota'),
        '5', $gbchoices));

    $settings->add(new admin_setting_configcheckbox(
        'block_disk_quota/do_email_admins',
        get_string('do_email_admins', 'block_disk_quota'),
        get_string('do_email_admins_desc', 'block_disk_quota'),
        0));

    $settings->add(new admin_setting_email_list_custom(
        'block_disk_quota/email_others',
        get_string('email_others', 'block_disk_quota'),
        get_string('email_others_desc', 'block_disk_quota'),
        '',
        PARAM_EMAIL,
        255));

    $settings->add(new admin_setting_configduration(
        'block_disk_quota/near_quota_warn_frequency',
        get_string('near_quota_warn_email_frequency', 'block_disk_quota'),
        get_string('near_quota_warn_email_frequency_desc', 'block_disk_quota'),
        14
    ));

    $settings->add(new admin_setting_configduration(
        'block_disk_quota/over_quota_warn_frequency',
        get_string('over_quota_warn_email_frequency', 'block_disk_quota'),
        get_string('over_quota_warn_email_frequency_desc', 'block_disk_quota'),
        3
    ));

    $settings->add(new admin_setting_configtext(
        'block_disk_quota/support_telephone',
        get_string('support_telephone', 'block_disk_quota'),
        get_string('support_telephone_desc', 'block_disk_quota'),
        '',
        PARAM_TEXT,
        255));

    $settings->add(new admin_setting_configtext(
        'block_disk_quota/support_email',
        get_string('support_email', 'block_disk_quota'),
        get_string('support_email_desc', 'block_disk_quota'),
        '',
        PARAM_TEXT,
        255));
}