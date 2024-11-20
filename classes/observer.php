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
//
/**
 * @package   local_studentid
 * @copyright 2024 WiLsonWu
 * @author    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

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
        $created_date = $user->timecreated;

        // generate student ID
        $student_id = generate_student_id($student_id_format, $user->id, $created_date);

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