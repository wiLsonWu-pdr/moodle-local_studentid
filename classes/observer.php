<?php

require_once(__DIR__ . '/../lib.php');

class local_studentid_observer {

    public static function user_created(\core\event\user_created $event) {
        global $DB;

        // get user record
        $user = $DB->get_record('user', ['id' => $event->objectid], '*', MUST_EXIST);
        
        // get student ID setting
        $use_student_id = get_user_preferences('use_student_id', false);
        
        // get student ID format
        $student_id_format = get_user_preferences('student_id_format', 'student_');
        
        // get account create date
        $createdDate = $user->timecreated;

        // generate student ID
        $student_id = generate_student_id($student_id_format, $user->id, $createdDate);

        // update username to be student ID
        $user->username = $student_id;

        $transaction = $DB->start_delegated_transaction();
        try {
            // according to user setting to decide update username or not
            if ($use_student_id) {
                $DB->update_record('user', $user);
            }

            // insert record to studentid table
            $record = new stdClass();
            $record->userid = $user->id;
            $record->studentid = $student_id;
            $DB->insert_record('studentid', $record);
            
            $transaction->allow_commit();
        } catch (Exception $e) {
            $transaction->rollback($e);
        }
    }
}