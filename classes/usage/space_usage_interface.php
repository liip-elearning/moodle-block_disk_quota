<?php

namespace block_disk_quota\usage;

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
