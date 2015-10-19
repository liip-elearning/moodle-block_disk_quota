<?php

namespace block_disk_quota\usage;

/**
 * Class InternalSpaceUsage
 *
 * Provides detail about the space used by the files that Moodle manages.
 */
class internal_space_usage implements space_usage_interface {
    public function get_usage_details() {
        global $DB;
        $gigabyte = 1024 * 1024 * 1024;
        $used = $DB->get_records_sql("
            SELECT mimetype, sum(sum) / ? AS gb_used FROM (
                SELECT iq.mimetype, SUM(iq.filesize) FROM (
                        SELECT filesize, regexp_replace(replace(mimetype, 'application/vnd.moodle.backup', 'backup'), '/.+\$', '') AS mimetype FROM {files}
                        WHERE  filesize > 0 GROUP BY filesize, regexp_replace(replace(mimetype, 'application/vnd.moodle.backup', 'backup'), '/.+\$', ''), contenthash) iq
                GROUP BY iq.mimetype
                UNION VALUES
                    ('audio',0),
                    ('backup',0),
                    ('document',0),
                    ('application',0),
                    ('video',0),
                    ('image',0),
                    ('text', 0)
            ) as dropzeros
            GROUP BY dropzeros.mimetype
        ", array($gigabyte));

        $total = 0;
        $breakdown = array();

        foreach($used as $record) {
            $total += $record->gb_used;
            $breakdown[$record->mimetype] = $record->gb_used;
        }
        if (!isset($breakdown['unknown'])) {
            $breakdown['unknown'] = 0;
        }
        return array(
            'total_gb' => $total,
            'breakdown' => $breakdown
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
