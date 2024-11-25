<?php
// This file is part of Moodle - http://moodle.org/
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Observer class for handling user creation events.
 *
 * This class listens for user creation events and manages student IDs.
 *
 * @package   local_studentid
 * @copyright 2024 WiLsonWu
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../lib.php');

/**
 * Class localStudentIdObserver
 *
 * Handles events related to student ID management.
 */
class localStudentIdObserver {

    /**
     * User created event handler.
     *
     * This method is triggered when a user is created.
     *
     * @param \core\event\user_created $event Event object.
     * @return void
     */
    public static function userCreated(\core\event\user_created $event) {
        global $DB;

        // Get user record.
        $user = $DB->get_record('user', ['id' => $event->objectid], '*', MUST_EXIST);
        
        // Get student ID setting.
        $useStudentId = get_user_preferences('useStudentId', false);
        
        // Get student ID format.
        $studentIdFormat = get_user_preferences('studentIdFormat', 'student_');
        
        // Get account create date.
        $createdDate = $user->timecreated;

        // Generate student ID.
        $studentId = generate_student_id($studentIdFormat, $user->id, $createdDate);

        // Update username to be student ID.
        $user->username = $studentId;

        $transaction = $DB->start_delegated_transaction();
        try {
            // Update username based on user setting.
            if ($useStudentId) {
                $DB->update_record('user', $user);
            }

            // Insert record to studentid table.
            $record = new stdClass();
            $record->userid = $user->id;
            $record->studentid = $studentId;
            $DB->insert_record('studentid', $record);
            
            $transaction->allow_commit();
        } catch (Exception $e) {
            $transaction->rollback($e);
        }
    }
}