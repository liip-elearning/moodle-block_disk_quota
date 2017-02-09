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
    $activeusers = array(50, 300, 1500, 3000, 9000, 18000, 30000);
    $activeusersstrings = array_map('strval', $activeusers);
    $activeuserschoices = array_combine($activeusersstrings, $activeusersstrings);

    $settings->add(new admin_setting_configcheckbox(
        'block_disk_quota/enabled',
        get_string('enabled', 'block_disk_quota'),
        get_string('enabled_desc', 'block_disk_quota'),
        0));

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
        'block_disk_quota/nearing_quota_warn_email_frequency',
        get_string('nearing_quota_warn_email_frequency', 'block_disk_quota'),
        get_string('nearing_quota_warn_email_frequency_desc', 'block_disk_quota'),
        14 * 24 * 60 * 60
    ));

    $settings->add(new admin_setting_configduration(
        'block_disk_quota/over_quota_warn_email_frequency',
        get_string('over_quota_warn_email_frequency', 'block_disk_quota'),
        get_string('over_quota_warn_email_frequency_desc', 'block_disk_quota'),
        3 * 24 * 60 * 60
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

    $settings->add(new admin_setting_configtext(
        'block_disk_quota/heartbeat_email',
        get_string('heartbeat_email', 'block_disk_quota'),
        get_string('heartbeat_email_desc', 'block_disk_quota'),
        '',
        PARAM_TEXT,
        255));

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/quota_activeusers',
        get_string('quota_activeusers', 'block_disk_quota'),
        get_string('quota_activeusers_desc', 'block_disk_quota'),
        '300', $activeuserschoices));
}
