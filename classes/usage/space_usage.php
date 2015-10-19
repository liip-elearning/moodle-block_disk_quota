<?php

namespace block_disk_quota\usage;

class space_usage {

    /**
     * @var array of space_usage_interface-implementing instances
     */
    var $usagecollectors = array();

    /**
     * @param array $usagecollectors array of space_usage_interface-implementing instances
     * @throws \InvalidArgumentException
     */
    function __construct($usagecollectors) {
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

        // Sum up the values from all collectors:
        foreach ($this->usagecollectors as $collector) {
            /* @var $collector space_usage_interface */
            $detail = $collector->get_usage_details();
            $details['total_gb'] += $detail['total_gb'];
            $breakdown = $detail['breakdown'];
            foreach ($breakdown as $name => $value) {
                if (isset($all_breakdown[$name])) {
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
