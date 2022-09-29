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

namespace block_disk_quota\task;
use block_disk_quota\usage\quota_manager;
use core\task\scheduled_task;

defined('MOODLE_INTERNAL') || die();

class get_disk_usage extends scheduled_task {

    public function get_name() {
        return get_string('task_get_disk_usage', 'block_disk_quota');
    }


//P.T. 29.09.2022 added conditions to have automatic site block optional ('block_site_enabled')
    public function execute() {
        $settings = get_config('block_disk_quota');
        $hardlimit = $settings->quota_gb + $settings->overage_limit_gb;
        $warnlimit = $settings->quota_gb - $settings->warn_when_within_gb_of_limit;
        $manager = new quota_manager();
        $used = $manager->get_total_disk_space_used();
        $manager->record_space_used($used, $settings->quota_gb);
        if ($settings->enabled && $settings->block_site_enabled) {
            if ($used > $hardlimit) {
                $manager->block_site_if_hard_limit_exceeded($used, $hardlimit);
                $manager->notify_site_blocked($used, $settings);
            } else if ($used > $settings->quota_gb) {
                $manager->notify_over_quota($used, $settings);
            } else if ($used >= $warnlimit) {
                $manager->notify_near_quota($used, $settings);
              }
        } else if ($settings->enabled) {
          if ($used >= $hardlimit) {
              $manager->notify_over_quota($used, $settings);
          } else if ($used > $settings->quota_gb) {
              $manager->notify_over_quota($used, $settings);
          } else if ($used >= $warnlimit && $used <= $settings->quota_gb) {
              $manager->notify_near_quota($used, $settings);
            }
          }



        $today = date('Y.m.d', time());
        if (!isset($settings->last_measurement_reduction) or $settings->last_measurement_reduction != $today) {
            $manager->reduce_old_measurements();
            set_config('last_measurement_reduction', $today, 'block_disk_quota');
        }
    }

    /**
     * Don't allow disabling at all.
     */
    public function get_run_if_component_disabled() {
        return true;
    }

    public function set_disabled($disabled) {
        // No-op.
        $disabled;
    }

    public function get_disabled() {
        return false;
    }

    /*
     * Don't allow less-than-every-hour runs.
     */
    public function get_hour() {
        return '*';
    }

    public function get_day() {
        return '*';
    }

    public function get_month() {
        return '*';
    }

    public function get_day_of_week() {
        return '*';
    }
}
