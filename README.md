# Disk Quota block for Moodle

## Overview
This plugin allows automatically disabling the Moodle if it's total disk usage
exceeds the defined site-wide quota.  It allows seeing how much space is
currently being used and the currently set quota.  A detail view is available
to show what kind of files (e.g. backup, video, audio, document) are using
up how much space.

The use case for this plugin is for a managed Moodle.  It is assumed that
the Moodle admin users should not be allowed to change most of the settings
for this plugin.

The total disk usage details are collected every 10 minutes (assuming
that the Moodle cron is running at least every 10 minutes), and if the
disk quota is near to being exceeded or has been exceed, a warning email is
sent to the admins (and other email addresses, if configured).  These mails
are not sent every 10 minutes; you can configure the interval between when
repeated warning mails should be sent.

In case the hard upper limit over-quota disk usage has been reached, the
Moodle will be put into CLI maintenance mode, effectively disabling it
for all users.  When that happens, emails will also be sent to the admins.
The only way to re-enable access to the Moodle at that point is to remove
the climaintenance.html file from the Moodle's data directory.

## Installation

### Forced config settings

In config.php, define ``$CFG->forced_plugin_settings`` (or add to it, if already defined) something like this:
```
$CFG->forced_plugin_settings = array(
    'block_disk_quota'  => array(
        'enabled' => true, // Is 'false' by default
        'quota_gb' => 50,  // Quota allocated for the entire Moodle
        'warn_when_within_gb_of_limit' => 5,  // When within this many GB of limit, start sending warning mails
        'overage_limit_gb' => 5,  // How many GB over the limit to allow before auto-blocking the site
        'do_email_admins' => true,  // If true, all warning / site blocked mails will be sent to all admins
        'support_telephone' => '555 1234',
        'support_email' => 'support@example.com',
        'nearing_quota_warn_email_frequency' => 14 * 24 * 60 * 60,  // How often, in seconds, a warning mail will be sent when nearing quota
        'over_quota_warn_email_frequency' => 3 * 24 * 60 * 60,   // How often, in seconds, a warning mail will be sent when quota exceeded
        'heartbeat_email' => 'heartbeat+example@example.com', // Where to send the regular heartbeat email
        'quota_activeusers' => 300, // Active users' quota (connections in the last 365 days)
    )
);
```
This will prevent these settings from being changed by anyone that doesn't have access to change the config.php file itself.

### Install the plugin
After having placed the ``disk_quota`` directory in the Moodle's ``blocks/`` directory, visit
``/admin/index.php`` or run the CLI upgrade script to install the plugin.

## Uninstall
This plugin cannot be removed by the admin interface.
In order to bypass this, you can comment the ``xmldb_block_disk_quota_uninstall`` function in ``db/uninstall.php``.

## Usage
By default, only admin users can add a disk usage block, or view an existing
disk usage block or the disk usage details page.  To change this, change the
permissions for the role you want to give access to; look for the disk_quota
permissions that you need to change - they should be self-explanatory.

The disk usage block shows how much space has been used and the quota.  It
also contains a link to the detail page, which shows how much space different
types of files are using.

For users with appropriate permissions, the detail page can be seen, regardless
of whether or not there are any block instances by navigating to the
``/blocks/disk_quota/`` page in Moodle.

Note that no block instance needs to exist for the cron job, warning emails,
and automatic site blocking to work.

## Compatibility
This plugin should work on Moodle 2.7+.
The usage detail page may not work if using a non-PosgreSQL database.

## TODO
* Nicer visual indication of current space used.
* Handle local disk usage of repositories other than those tracked in the Moodle database.
