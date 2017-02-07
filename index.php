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

$PAGE->set_url('/blocks/disk_quota/index.php');
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('report');

// Print the header.
$title = get_string("pluginname", "block_disk_quota");
$PAGE->navbar->add($title);
$PAGE->set_title($title);
echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($title));


$renderer = $PAGE->get_renderer('block_disk_quota');
echo $renderer->usage_detail();
echo $OUTPUT->footer();
