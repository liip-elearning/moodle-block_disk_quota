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
 * class block_disk_quota
 *
 * @package    block_disk_quota
 * @copyright  2015 Liip AG {@link http://liip.ch}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_disk_quota\usage\quota_manager;

/**
 * How it works:
 *
 * The cron runs every x minutes and records the space used.
 * It also checks how the space used relates to the quota.
 * - If lower than, but near quota, send a mail (but not every time the cron runs)
 * - If above, but not way above, send a mail (every day?)
 * - If above the hard limit quota, put site in maintenance mode with a message about being over quota.
 *
 * Configuration:
 * The following block settings variables must be defined in code (e.g. in config.php), so that the admin users
 * can not change them:
 * $CFG->forced_plugin_settings = array(
 *     'block_disk_quota'  => array(
 *         'quota_gb' => 50,  // Quota allocated for the entire Moodle
 *         'warn_when_within_gb_of_limit' => 5,  // When within this many GB of limit, start sending warning mails
 *         'overage_limit_gb' => 5,  // How many GB over the limit to allow before auto-blocking the site
 *         'do_email_admins' => true,  // If true, all warning / site blocked mails will be sent to all admins
 *         'support_telephone' => '555 1234',
 *         'support_email' => 'support@example.com',
 *         // How often, in seconds, a warning mail will be sent when nearing quota
 *         'nearing_quota_warn_email_frequency' => 14 * 24 * 60 * 60,
 *         // How often, in seconds, a warning mail will be sent when quota exceeded
 *         'over_quota_warn_email_frequency' => 3 * 24 * 60 * 60,
 *     )
 * );
 *
 */

class block_disk_quota extends block_base {

    /**
     * Initialises the block
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_disk_quota');
    }

    /**
     * Returns the content object
     *
     * @return stdObject
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        // TODO: Renderer could show a color-coded status bar or something like that.
        $renderer = $this->page->get_renderer('block_disk_quota');
        $this->content->text = $renderer->current_usage();
        return $this->content;
    }

    /**
     * Which page types this block may appear on.
     *
     * @return array page-type prefix => true/false.
     */
    public function applicable_formats() {
        return array('all' => true, 'my' => true, 'tag' => false);
    }

    public function quota_settings() {
        return get_config('block_disk_quota');
    }

    /**
     * Cron is defined here instead of as a task so that the administrator can not change the
     * schedule of the task or prevent the task from running.
     */
    public function cron() {
        try {
            $settings = $this->quota_settings();
            if ($settings->enabled) {
                $hardlimit = $settings->quota_gb + $settings->overage_limit_gb;
                $warnlimit = $settings->quota_gb - $settings->warn_when_within_gb_of_limit;
                $manager = new quota_manager();
                $used = $manager->get_total_disk_space_used();
                $manager->record_space_used($used, $settings->quota_gb);
                if ($manager->block_site_if_hard_limit_exceeded($used, $hardlimit)) {
                    $manager->notify_site_blocked($used, $settings);
                } else if ($used >= $settings->quota_gb) {
                    $manager->notify_over_quota($used, $settings);
                } else if ($used >= $warnlimit) {
                    $manager->notify_near_quota($used, $settings);
                }

                $today = date('Y.m.d', time());
                if (!isset($settings->last_measurement_reduction) or $settings->last_measurement_reduction != $today) {
                    $manager->reduce_old_measurements();
                    set_config('last_measurement_reduction', $today, 'block_disk_quota');
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Controls whether or not it is visible to the current user.
     */
    public function is_empty() {
        return !has_capability('block/disk_quota:viewblock', context_system::instance());
    }

    public function has_config() {
        return true;
    }
}

