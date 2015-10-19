<?php

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
        $data = (string)$data;
        $data = trim($data, " ,\t\n\r\0\x0B");
        return parent::write_setting($data);
    }
    /**
     * Validate that there is an empty string or a comma-separated list of valid email addresses.
     *
     * @param $data
     * @return mixed true if validation is OK, error message string otherwise
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
            } catch (invalid_parameter_exception $e) {
                return get_string('err_invalid_email_address', 'block_disk_quota', $i + 1);
            }
        }
        return true;
    }
}
