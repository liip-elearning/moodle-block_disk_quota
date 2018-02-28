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

use block_disk_quota\usage\quota_manager;
use block_disk_quota\usage\space_usage;

defined('MOODLE_INTERNAL') || die;

/**
 * disk_quota block renderer
 */
class block_disk_quota_renderer extends plugin_renderer_base {

    public function current_usage() {
        $vars = array(
            'usage' => $this->disk_quota_usage(),
            'activeusers' => $this->activeusers_usage(),
            'url' => new moodle_url('/blocks/disk_quota/index.php'),
            'link_text' => get_string('supplyinfo', 'moodle'),
        );
        return $this->render_from_template('block_disk_quota/current_usage', $vars);
    }

    public function disk_quota_usage() {
        $quotamanager = new quota_manager();
        $info = $quotamanager->get_quota_and_space_used_gb();
        $info->quota = round(floatval($info->quota), 1);

        $classes = '';
        if (is_null($info->used)) {
            $info->used = 'unknown';
        } else {
            $info->used = round(floatval($info->used), 3);
            $diff = $info->quota - $info->used;

            if ($diff <= 0) {
                $classes .= ' disk-quota--danger';
            } elseif ($diff <= $info->warn_limit) {
                $classes .= ' disk-quota--warning';
            }
        }
        $vars = array(
            'space_used' => get_string('quota_used', 'block_disk_quota', $info),
            'classes' => $classes
        );
        return $this->render_from_template('block_disk_quota/disk_quota_usage', $vars);
    }

    public function usage_detail() {
        $vars = array(
            'overview' => $this->disk_quota_usage(),
            'detail' => $this->usage_detail_table(),
        );
        return $this->render_from_template('block_disk_quota/usage_detail', $vars);
    }

    public function usage_detail_table() {
        $quotamanager = new quota_manager();
        $detail = $quotamanager->get_usage_details();
        $table = new html_table();
        $table->head = array(
            get_string('type', 'search'),
            get_string('gigabytes_used', 'block_disk_quota')
        );
        $data = array();

        $breakdown = $detail['breakdown'];
        arsort($breakdown);
        foreach ($breakdown as $type => $value) {
            $data[] = array($type, round($value, 3));
        }
        $table->data = $data;
        return html_writer::table($table);
    }

    public function activeusers_usage() {
        $quotamanager = new quota_manager();
        $info = $quotamanager->get_activeusers_and_quota();

        $classes = $info->activeusers >= $info->quota ? ' disk-quota--warning' : '';

        $vars = array(
            'active_users' => get_string('active_users', 'block_disk_quota', $info),
            'classes' => $classes
        );
        return $this->render_from_template('block_disk_quota/activeusers_usage', $vars);
    }

    public function activeusers_quota() {
        return $this->render_from_template('block_disk_quota/activeusers_quota', $this->activeusers_usage());
    }
}
