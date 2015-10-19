<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'block/disk_quota:myaddinstance' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
        ),
    ),

    'block/disk_quota:addinstance' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
        ),
    ),

    'block/disk_quota:viewusage' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
        ),
    ),

    'block/disk_quota:viewblock' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
        ),
    ),
);
