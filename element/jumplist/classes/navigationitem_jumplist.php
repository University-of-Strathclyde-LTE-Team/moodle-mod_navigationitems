<?php
namespace navigationitem_jumplist;

use mod_navigationitems\navigationitemplugin;
use renderer_base;

class navigationitem_jumplist extends navigationitemplugin {
    private $cminfo ;
    private $courseinfo;
    function __construct($cminfo) {
        $this->cminfo = $cminfo;
        $this->courseinfo = $this->cminfo->get_modinfo();
    }
    protected function get_sections() {
        $format = course_get_format($this->courseinfo->get_course_id());
        $sections = $this->courseinfo->get_section_info_all();
        $context = [];
        foreach ($sections as $section) {
            $context[] = (object) [
                'name' => $format->get_section_name($section),
                'url' => new \moodle_url('#coursecontentcollapse'.$section->section),
                'last' => false,
            ];
        }
        $last = array_pop($context);
        $last->last = true;
        $context[] = $last;
        return $context;
    }
    public function export_for_template(renderer_base $output) {
        $context = [
            'sections' => $this->get_sections(),
        ];

        return (object)$context;
    }
}