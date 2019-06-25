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

namespace block_disk_quota\usage;

defined('MOODLE_INTERNAL') || die();

interface space_usage_interface {
    /**
     * @return array with following structure:
     *
     *   [
     *      'total_gb': 123123.0234,  # Gigabytes used (do not round)
     *      'breakdown': [
     *          # 'unknown' is required, others are optional.
     *          # If only providing 'unknown', it should be equal to the 'total_gb' value
     *          'unknown': 1234.566,  # Gigabytes used (do not round)
     *          'video': 1234.566,    # Gigabytes used (do not round)
     *          # etc.
     *      ]
     *   ]
     */
    public function get_usage_details();

    /**
     * @return float number of gigabytes used
     */
    public function get_total_used();
}
