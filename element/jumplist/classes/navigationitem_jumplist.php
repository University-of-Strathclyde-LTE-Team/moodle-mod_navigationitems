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

        //var_dump($this->courseinfo->get_sections());
        $sections = $this->cm_info->get_sections();
        foreach ($sections as $section) {
            $sectioninfo = $this->cm_info->get_section_info($section);
            var_dump($sectioninfo);
        }
        //var_dump($sections);
        $sections = [
                (object)[
                    'name' => "Section 1",
                    'url' => "URL",
                    'last' => false
                ],
                (object)[
                        'name' => "Section 2",
                        'url' => "URL",
                        'last' => true
                ]
        ];
        return $sections;
    }
    public function export_for_template(renderer_base $output) {
        $context = [
            'sections' => $this->get_sections(),
        ];

        return (object)$context;
    }
}