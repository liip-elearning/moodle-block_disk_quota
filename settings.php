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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/adminlib.php');

if ($ADMIN->fulltree) {
    $gb = array_merge(range(0, 9),  range(10, 300, 5));
    $gbstrings = array_map('strval', $gb);
    $gbchoices = array_combine($gbstrings, $gbstrings);
    $activeusers = array(50, 300, 1500, 3000, 9000, 18000, 30000);
    $activeusersstrings = array_map('strval', $activeusers);
    $activeuserschoices = array_combine($activeusersstrings, $activeusersstrings);

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/quota_gb',
        get_string('quota_gb', 'block_disk_quota'),
        get_string('quota_gb_desc', 'block_disk_quota'),
       '50', $gbchoices
    ));

    $settings->add(new admin_setting_configselect(
        'block_disk_quota/quota_activeusers',
        get_string('quota_activeusers', 'block_disk_quota'),
        get_string('quota_activeusers_desc', 'block_disk_quota'),
        '300', $activeuserschoices
    ));
}
