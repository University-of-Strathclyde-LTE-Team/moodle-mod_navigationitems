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
 * Add label form
 *
 * @package mod_navigationitems
 * @copyright  2024 Michael Hughes, University Of Strathclyde
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_navigationitems\navigationitemplugin;

defined('MOODLE_INTERNAL') || die;

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_navigationitems_mod_form extends moodleform_mod {
    function definition() {
        global $PAGE;
        $PAGE->force_settings_menu();
        $mform = $this->_form;

        $mform->addElement('header', 'generalhdr', get_string('general'));

        $elements = navigationitemplugin::make_menu(navigationitemplugin::get_elements());
        //var_dump($elements);
        $mform->addElement('select', 'introeditor[text]',
            get_string('navigationelement', 'navigationitems'),
                $elements
        );
        $mform->addElement('hidden', 'introeditor[format]');
        $mform->setType("introeditor[format]", PARAM_RAW);
        $mform->setDefault("introeditor[format]", "");
        $mform->addElement('hidden', 'introeditor[itemid]');
        $mform->setType("introeditor[itemid]", PARAM_RAW);
        $mform->setDefault("introeditor[foritemid]", "");
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
}