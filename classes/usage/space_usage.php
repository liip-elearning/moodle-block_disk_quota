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

class space_usage {
    /**
     * @var array of space_usage_interface-implementing instances
     */
    private $usagecollectors = array();

    /**
     * @param array $usagecollectors array of space_usage_interface-implementing instances
     * @throws \InvalidArgumentException
     */
    public function __construct($usagecollectors) {
        if (count($usagecollectors) == 0) {
            throw new \InvalidArgumentException("usage_collectors must not be empty");
        }
        $this->usagecollectors = $usagecollectors;
    }

    public function total_used() {
        $total = 0.0;
        foreach ($this->usagecollectors as $collector) {
            /* @var $collector space_usage_interface */
            $total += $collector->get_total_used();
        }
        return $total;
    }

    public function usage_details() {
        $details = array (
            'total_gb' => 0.0,
            'breakdown' => array(
                'unknown' => 0.0,
            )
        );
        $allbreakdown = $details['breakdown'];

        // Sum up the values from all collectors.
        foreach ($this->usagecollectors as $collector) {
            /* @var $collector space_usage_interface */
            $detail = $collector->get_usage_details();
            $details['total_gb'] += $detail['total_gb'];
            $breakdown = $detail['breakdown'];
            foreach ($breakdown as $name => $value) {
                if (isset($allbreakdown[$name])) {
                    $allbreakdown[$name] += $value;
                } else {
                    $allbreakdown[$name] = $value;
                }
            }
        }
        $details['breakdown'] = $allbreakdown;
        return $details;
    }
}
