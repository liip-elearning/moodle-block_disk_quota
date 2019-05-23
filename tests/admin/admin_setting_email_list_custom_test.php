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
namespace block_disk_quota\tests\admin;

use advanced_testcase;
use block_disk_quota\admin\admin_setting_email_list_custom;

defined('MOODLE_INTERNAL') || die();

/**
 * Class admin_setting_email_list_custom_test
 *
 * @package block_disk_quota\tests\admin
 *
 *  Unit tests for blocks/disk_quota/classes/task/get_disk_usage.php.
 *
 */
class admin_setting_email_list_custom_test extends advanced_testcase {

    /**
     * Test email seetings are validated => ok if empty
     */
    public function test_admin_setting_email_list_custom_empty() {
        $adminemail = $this->init_admin_email();
        $this->assertTrue($adminemail->validate(''));
    }

    /**
     * Test email seetings are validated => ok
     */
    public function test_admin_setting_email_list_custom_email_ok() {
        $adminemail = $this->init_admin_email();
        $this->assertTrue($adminemail->validate('test@example.com, test@example.com'));
    }

    /**
     * Test email settings are validated => failing
     */
    public function test_admin_setting_email_list_custom_email_failed() {
        $adminemail = $this->init_admin_email();
        $this->assertTrue(true !== $adminemail->validate('testexample'));
    }

    protected function init_admin_email() {
        return new admin_setting_email_list_custom('test', 'test', 'test', '');
    }
}