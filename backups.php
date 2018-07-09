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

require_once("../../config.php");
require_once($CFG->dirroot.'/mod/assign/locallib.php');

require_login();
$systemcontext = context_system::instance();
require_capability('block/disk_quota:viewusage', $systemcontext);

$PAGE->set_url('/blocks/disk_quota/backups.php');
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('report');

// Print the header.
$title = get_string("pluginname", "block_disk_quota");
$PAGE->navbar->add($title);
$PAGE->navbar->add("Backups");
$PAGE->set_title($title);
echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($title));


$page = optional_param('page', 1, PARAM_INT);
$per_page = 1;

$renderer = $PAGE->get_renderer('block_disk_quota');
echo $renderer->disk_backup_usage($page, $per_page);


echo $OUTPUT->footer();
