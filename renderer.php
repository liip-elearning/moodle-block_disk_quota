<?php

use block_disk_quota\usage\quota_manager;

defined('MOODLE_INTERNAL') || die;

/**
 * disk_quota block renderer
 */
class block_disk_quota_renderer extends plugin_renderer_base {

    public function current_usage() {
        $info = quota_manager::get_quota_and_space_used_gb();
        $info->quota = round(floatval($info->quota), 1);
        if (is_null($info->used)) {
            $info->used = 'unknown';
        }
        return get_string('quota_used', 'block_disk_quota', $info);
    }
}
