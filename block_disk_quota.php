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
defined('MOODLE_INTERNAL') || die();

/**
 * class block_disk_quota
 *
 * @package    block_disk_quota
 * @copyright  2015 Liip AG {@link http://liip.ch}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
     * Controls whether or not it is visible to the current user.
     */
    public function is_empty() {
        return !has_capability('block/disk_quota:viewblock', context_system::instance());
    }

    public function has_config() {
        return true;
    }
}

