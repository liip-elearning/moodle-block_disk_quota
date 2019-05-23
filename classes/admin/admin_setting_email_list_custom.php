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

namespace block_disk_quota\admin;

use admin_setting_configtext;

global $CFG;
require_once($CFG->libdir . '/adminlib.php');

class admin_setting_email_list_custom extends admin_setting_configtext {

    /**
     * Ensure that $data is a string, and trim off any leading/trailing comma or whitespace
     * before calling parent method.
     *
     * @param mixed $data
     * @return mixed|string
     */
    public function write_setting($data) {
        $data = (string) $data;
        $data = trim($data, " ,\t\n\r\0\x0B");
        return parent::write_setting($data);
    }

    /**
     * Validate that there is an empty string or a comma-separated list of valid email addresses.
     *
     * @param $data
     * @return mixed true if validation is OK, error message string otherwise
     * @throws coding_exception
     */
    public function validate($data) {
        $localdata = str_replace(' ', '', $data);
        if (empty($localdata)) {
            return true;
        }
        $addresses = explode(',', $localdata);
        foreach ($addresses as $i => $address) {
            try {
                validate_param($address, PARAM_EMAIL);
            } catch (\invalid_parameter_exception $e) {
                return get_string('err_invalid_email_address', 'block_disk_quota', $i + 1);
            }
        }
        return true;
    }
}
