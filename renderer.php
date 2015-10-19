<?php

use block_disk_quota\usage\quota_manager;
use block_disk_quota\usage\space_usage;

defined('MOODLE_INTERNAL') || die;

/**
 * disk_quota block renderer
 */
class block_disk_quota_renderer extends plugin_renderer_base {

    public function current_usage() {
        $usage = $this->disk_quota_usage();
        $template = '
            {% usage %}
            <a class="disk_quota_detail_link" href="{% url %}">{% link_text %}</a>
        ';

        $vars = array(
            'usage' => $usage,
            'url' => new moodle_url('/blocks/disk_quota/index.php'),
            'link_text' => get_string('supplyinfo', 'moodle'),
        );

        return $this->replace_placeholders($template, $vars);
    }

    public function disk_quota_usage() {
        $quotamanager = new quota_manager();
        $info = $quotamanager->get_quota_and_space_used_gb();
        $info->quota = round(floatval($info->quota), 1);
        if (is_null($info->used)) {
            $info->used = 'unknown';
        }
        $template = '
            <div class="disk_quota_usage">
                {% space_used %}
            </div>
        ';
        $vars = array('space_used' => get_string('quota_used', 'block_disk_quota', $info));
        return $this->replace_placeholders($template, $vars);

    }

    public function usage_detail() {
        $usage = $this->disk_quota_usage();
        $detail = $this->usage_detail_table();

        $template = '
            <div class="disk_quota_usage_detail">
                <div class="overview">
                    {% overview %}
                </div>
                <div class="detail">
                    {% detail %}
                </div>
            </div>
        ';
        return $this->replace_placeholders($template, array('overview' => $usage, 'detail' => $detail));
    }

    public function usage_detail_table() {
        $quotamanager = new quota_manager();
        $detail = $quotamanager->get_usage_details();
        $table = new html_table();
        $table->head = array(
            get_string('type', 'search'),
            get_string('gigabytes_used', 'block_disk_quota')
        );
        $data = array();

        $breakdown = $detail['breakdown'];
        arsort($breakdown);
        foreach ($breakdown as $type => $value) {
            $data[]= array($type, round($value, 3));
        }
        $table->data = $data;
        return html_writer::table($table);
    }


    /**
     * A very simple and fragile templating system.
     * @param $str
     * @param $placeholders
     * @return mixed
     */
    public function replace_placeholders($str, $placeholders) {
        $search = array();
        $replace = array();
        foreach($placeholders as $key => $value) {
            $search[]= "{% $key %}";
            $replace[]= $value;
        }
        return str_replace($search, $replace, $str);
    }
}
