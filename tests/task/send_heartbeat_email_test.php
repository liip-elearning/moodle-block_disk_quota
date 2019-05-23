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
 * Unit tests for blocks/disk_quota/classes/task/get_disk_usage.php
 *
 */

namespace block_disk_quota\tests\tasks;

use advanced_testcase;
use block_disk_quota\task\send_heartbeat_email;

defined('MOODLE_INTERNAL') || die();

class send_heartbeat_email_test_testcase extends advanced_testcase {
    protected function setUp() {
        unset_config('noemailever');
        $this->resetAfterTest();
    }

    /**
     * Test email are sent
     */
    public function test_execute_email_is_sent() {
        $sink = $this->redirectEmails();

        // Be sure we have an email in the config.
        set_config('heartbeat_email', "test-to@example.com", 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();

        $this->assertCount(1, $sink->get_messages());
    }

    /**
     * Test email from
     */
    public function test_from_field() {
        $sink = $this->redirectEmails();

        // Be sure we have an email in the config.
        set_config('heartbeat_email', "test-to@example.com", 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();

        if (count($sink->get_messages()) !== 1) {
            $this->markTestIncomplete("No message was found");
            return;
        }

        $message = $sink->get_messages()[0];
        $this->assertEquals("noreply@www.example.com", $message->from);
    }

    /**
     * Test email to
     */
    public function test_to_field() {
        $sink = $this->redirectEmails();

        // Be sure we have an email in the config.
        set_config('heartbeat_email', "test-to@example.com", 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();

        if (count($sink->get_messages()) !== 1) {
            $this->markTestIncomplete("No message was found");
            return;
        }

        $message = $sink->get_messages()[0];
        $this->assertEquals("test-to@example.com", $message->to);
    }

    /**
     * Test invalid email
     */
    public function test_execute_no_email_is_sent() {
        $sink = $this->redirectEmails();

        // Be sure we do not have an email in the config.
        set_config('heartbeat_email', '', 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();
        $this->assertDebuggingCalled("Can not send email to user without email: -1");

        $this->assertCount(0, $sink->get_messages());

    }

    /**
     * Test email body
     */
    public function test_execute_email_body() {
        $sink = $this->redirectEmails();

        // Be sure we do not have an email in the config.
        set_config('heartbeat_email', 'test-to@example.com', 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();

        if (count($sink->get_messages()) !== 1) {
            $this->markTestIncomplete("No message was found");
            return;
        }

        $message = $sink->get_messages()[0];
        $this->assertEquals("\nEmail heartbeat for Moodle site URL https://www.example.com/moodle\n", $message->body);
    }

    /**
     * Test email subject
     */
    public function test_execute_email_subject() {
        $sink = $this->redirectEmails();

        // Be sure we do not have an email in the config.
        set_config('heartbeat_email', 'test-to@example.com', 'block_disk_quota');

        $t = new send_heartbeat_email();
        $t->execute();

        if (count($sink->get_messages()) !== 1) {
            $this->markTestIncomplete("No message was found");
            return;
        }

        $message = $sink->get_messages()[0];
        $this->assertEquals("Email heartbeat", $message->subject);
    }
}