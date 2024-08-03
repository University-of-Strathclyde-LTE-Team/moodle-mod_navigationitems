<?php

namespace mod_navigationitems;

abstract class navigationitemplugin implements \templatable, \renderable {
    public function get_sort_order() {
        $order = get_config(get_class($this), 'sortorder');
        return $order ? $order : 0;
    }
    public static function get_element($name, $cminfo) {
        $pluginclass = "\\navigationitem_{$name}\\navigationitem_{$name}";

        $plugin = new $pluginclass($cminfo);
        if ($plugin instanceof navigationitemplugin) {
            return $plugin;
        }

        return null;
    }
    public static function get_elements() {
        global $CFG;
        $result = [];
        $names = \core_component::get_plugin_list('navigationitem');
        return $names;
    }
    public static function make_menu($plugins) {
        array_walk($plugins, function(&$item, $key) {
            $item = get_string('modulename', 'navigationitem_'.$key);
        });
        return $plugins;
    }
}