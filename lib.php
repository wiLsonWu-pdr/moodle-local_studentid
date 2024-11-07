<?php
defined('MOODLE_INTERNAL') || die();

class local_studentid_observer {

    public static function user_created(\core\event\user_created $event) {
        global $DB;

        $maxuserid_sql = "SELECT MAX(id) AS maxuserid FROM {user}";
        $maxuserid = $DB->get_record_sql($maxuserid_sql);// get user table max ID
        $userid = isset($maxuserid) ? $maxuserid->maxuserid + 1 : 1; // if no，initial 1
        $studentid = 'SID-' . str_pad($userid, 6, '0', STR_PAD_LEFT); // generate user ID
        
        $user = $DB->get_record('user', array('id' => $userid));

        $record = new stdClass();
        $record->userid = $userid;
        $record->studentid = $studentid;
        $DB->insert_record('studentid', $record);
        
        if (!empty($user->use_studentid)) {
            
            // 更新用户名为学生 ID
            $user->username = $studentid;
            
            // 更新用户记录
            $DB->update_record('user', $user);
        }
    }
}


function local_studentid_extend_user_edit_form(user_editadvanced_form $mform, $user) {
    $form = new local_studentid_user_edit_form();
    $form->definition();
}