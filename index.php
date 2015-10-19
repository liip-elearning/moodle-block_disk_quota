<?php

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
