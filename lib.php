<?php

function navigationitems_supports($feature) {
    switch($feature) {
        case FEATURE_IDNUMBER:                return true;
        case FEATURE_GROUPS:                  return false;
        case FEATURE_GROUPINGS:               return false;
        case FEATURE_MOD_INTRO:               return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return false;
        case FEATURE_GRADE_HAS_GRADE:         return false;
        case FEATURE_GRADE_OUTCOMES:          return false;
        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_BACKUP_MOODLE2:          return true;
        case FEATURE_NO_VIEW_LINK:            return true;
        case FEATURE_MOD_PURPOSE:             return MOD_PURPOSE_CONTENT;

        default: return null;
    }
}
function navigationitems_add_instance($data, $mform) {
    global $DB;
    $data->timemodified = time();
    $data->id = $DB->insert_record('navigationitems', $data);

    return $data->id;
}

function navigationitems_delete_instance($id) {
    global $DB;
    if (! $element = $DB->get_record("navigationitems", array("id"=>$id))) {
        return false;
    }
    $result = true;
    if (! $DB->delete_records("navigationitems", array("id"=>$element->id))) {
        $result = false;
    }
    return $result;
}

//function navigationitems_cm_info_dynamic($cm_info) {
function navigationitems_cm_info_view($cm_info) {
    global $OUTPUT, $DB;
    $element = $DB->get_record("navigationitems", array("id"=>$cm_info->instance));
    $plugin = \mod_navigationitems\navigationitemplugin::get_element($element->intro, $cm_info);
    $cm_info->set_content( $OUTPUT->render($plugin));
}