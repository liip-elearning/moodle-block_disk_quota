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

class send_heartbeat_email extends \core\task\scheduled_task {
    public function get_name() {
        return get_string('task_send_heartbeat_email', 'block_disk_quota');
    }

    public function execute() {
        $settings = get_config('block_disk_quota');
        $manager = new quota_manager();
        $manager->send_heartbeat_email($settings);
    }
}
