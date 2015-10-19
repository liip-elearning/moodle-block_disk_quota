<?php

namespace block_disk_quota\usage;

/**
 * Class InternalSpaceUsage
 *
 * Provides detail about the space used by the files that Moodle manages.
 */
class internal_space_usage implements space_usage_interface {
    public function get_usage_details() {
        // TODO: implement
        return array(
            'total_gb' => 12.21,
            'breakdown' => array(
                'unknown' => 10,
                'video' => 2.10,
                'documents' => 0.11,
            )
        );
    }

    public function get_total_used() {
        global $DB;
        $used = $DB->get_field_sql(
            "select sum(filesize) / (1024 * 1024 * 1024)
               from (select filesize from {files} group by filesize, contenthash) distinct_files");

        return $used === false ? 0 : $used;
    }
}
