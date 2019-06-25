<?php
// This file is part of Moodle - http://moodle.org/
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

/**
 * Unit tests for blocks/disk_quota/classes/usage/quota_manager.php
 * This file try to test the email notifications only.
 */

namespace block_disk_quota\tests\usage;

use advanced_testcase;
use block_disk_quota\usage\quota_manager;

defined('MOODLE_INTERNAL') || die();

class quota_manager_notify_test extends advanced_testcase {
    protected function setUp() {
        unset_config('noemailever');
        set_config('enabled', 1, 'block_disk_quota');
        set_config('overage_limit_gb', 2, 'block_disk_quota');
        set_config('warn_when_within_gb_of_limit', 1, 'block_disk_quota');
        set_config('last_measurement_reduction', "1997.01.01", 'block_disk_quota');
        set_config('do_email_admins', "1", 'block_disk_quota');
        unset_config('notification_nearing_quota_sent_date', 'block_disk_quota');
        $this->resetAfterTest();
    }

    /**
     * Test the total disk space used calculations.
     */
    public function test_notification_near_quota_first_time() {
        $sink = $this->redirectEmails();
        unset_config('notification_nearing_quota_sent_date', 'block_disk_quota');

        $t = new quota_manager();
        $t->notify_near_quota(0.9, get_config("block_disk_quota"));

        $this->assertCount(1, $sink->get_messages());
    }

    /**
     * Don't sent "near_quota" email if it was sent yesterday.
     */
    public function test_notification_near_quota_notsend() {
        $sink = $this->redirectEmails();
        $date = new \DateTimeImmutable("now");
        set_config('notification_nearing_quota_sent_date', $date->modify("-1 hour")->format("U"), 'block_disk_quota');
        set_config('nearing_quota_warn_email_frequency', 1, 'block_disk_quota');

        $quotamanager = new quota_manager();
        $quotamanager->notify_near_quota(0.9, get_config("block_disk_quota"));

        $this->assertCount(0, $sink->get_messages());
    }

    /**
     * Sent "near_quota" email if it was sent yesterday.
     */
    public function test_notification_near_quota_send() {
        $sink = $this->redirectEmails();
        $date = new \DateTimeImmutable("now");
        set_config('notification_nearing_quota_sent_date', $date->modify("-1 day")->format("U"),
                'block_disk_quota');
        set_config('nearing_quota_warn_email_frequency', 1, 'block_disk_quota');

        $quotamanager = new quota_manager();
        $quotamanager->notify_near_quota(0.9, get_config("block_disk_quota"));

        $this->assertCount(1, $sink->get_messages());
    }

    /**
     * Sent "site_blocked" email.
     */
    public function test_notification_site_blocked() {
        $sink = $this->redirectEmails();
        $quotamanager = new quota_manager();
        $quotamanager->notify_site_blocked(2.3, get_config("block_disk_quota"));

        $this->assertCount(1, $sink->get_messages());
    }

    /**
     * Don't sent "near_quota" email if it was sent yesterday.
     */
    public function test_notification_over_quota_notsend() {
        $sink = $this->redirectEmails();
        $date = new \DateTimeImmutable("now");
        set_config('notification_over_quota_sent_date', $date->modify("-1 hour")->format("U"), 'block_disk_quota');
        set_config('over_quota_warn_email_frequency', 1, 'block_disk_quota');

        $quotamanager = new quota_manager();
        $quotamanager->notify_over_quota(5.9, get_config("block_disk_quota"));

        $this->assertCount(0, $sink->get_messages());
    }

    /**
     * Sent "near_quota" email if it was sent yesterday.
     */
    public function test_notification_over_quota_send() {
        $sink = $this->redirectEmails();
        $date = new \DateTimeImmutable("now");
        set_config('notification_over_quota_sent_date', $date->modify("-1 day")->format("U"),
                'block_disk_quota');
        set_config('over_quota_warn_email_frequency', 1, 'block_disk_quota');

        $quotamanager = new quota_manager();
        $quotamanager->notify_over_quota(5.9, get_config("block_disk_quota"));

        $this->assertCount(1, $sink->get_messages());
    }
}