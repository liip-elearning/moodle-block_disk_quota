<?php

function xmldb_block_disk_quota_uninstall() {
    // Uncomment, to allow deletion:
    throw new moodle_exception('err_cannot_uninstall_plugin', 'block_disk_quota');
}
