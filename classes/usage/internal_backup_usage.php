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

/**
 * Class InternalSpaceUsage
 *
 * Provides detail about the space used by the files that Moodle manages.
 */
class internal_backup_usage {
    public function get_backup_paginated($limitfrom = 0, $limitnum = 0) {
        $result = new \stdClass();
        $result->total = $this->count();
        $result->limitfrom = $limitfrom;
        $result->limitnum = $limitnum;
        if ($result->total > 100 && $result->limitnum == 0) {
            $result->limitnum = 10;
        }

        $result->hasnext = $result->total > $result->limitfrom + $result->limitnum;
        $result->data = $this->get_backup_details($result->limitfrom, $result->limitnum);
        return $result;
    }

    public function get_backup_details($limitfrom = 0, $limitnum = 0) {
        global $DB;

        return $DB->get_records_sql(
                "SELECT file.id,file.mimetype, file.filename, file.filesize, file.timemodified, ".
                "file.contextid, course.id as course_id, course.fullname as course_name FROM {files} file ".
                "JOIN {context} co ON file.contextid = co.id ".
                "JOIN {course} course ON course.id = co.instanceid ".
                "WHERE file.filesize > 0 and file.mimetype like 'application/vnd.moodle.backup' ".
                "ORDER BY file.filesize DESC, file.timemodified ASC", array(), $limitfrom, $limitnum);
    }

    public function count() {
        static $count = null;
        if ($count !== null) {
            return $count;
        }

        global $DB;
        $count = $DB->count_records('files', [
                "mimetype" => 'application/vnd.moodle.backup'
        ]);
        return $count;
    }
}
