<?php

/**
 * Plugin info class.
 *
 * @package   block_disk_quota
 * @copyright 201 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_disk_quota\plugininfo;

use core\plugininfo\block;

defined('MOODLE_INTERNAL') || die();


class disk_quota extends block {
    public function is_uninstall_allowed() {
        return false;
    }
}
