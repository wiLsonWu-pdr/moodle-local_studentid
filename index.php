<?php
// This file is part of Moodle - http://moodle.org/
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See
// the GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Index page for the local_studentid plugin.
 *
 * This file provides the settings page for managing student ID preferences.
 *
 * @package   local_studentid
 * @copyright 2024 WiLsonWu
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__).'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');

require_login(); // Ensure the user is logged in.
require_capability('local/studentid:manage', context_system::instance()); // Check user capability.

admin_externalpage_setup('managelocalplugins');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('student_id_generate_setting', 'local_studentid'));

// Handle form submission.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && confirm_sesskey()) {
    $use_student_id = optional_param('use_student_id', false, PARAM_BOOL);
    $student_id_format = optional_param('student_id_format', 's', PARAM_TEXT);

    set_user_preference('use_student_id', $use_student_id);
    set_user_preference('student_id_format', $student_id_format);

    echo $OUTPUT->notification(get_string('setting_have_been_saved', 'local_studentid'), 'notifymessage');
}

// Get user preference settings.
$use_student_id = get_user_preferences('use_student_id', false);
$student_id_format = get_user_preferences('student_id_format', 'student_');

?>

<form method="post">
    <div>
        <label>
            <input type="checkbox" name="use_student_id" value="1" <?php echo $use_student_id ? 'checked' : ''; ?> />
            <?php echo get_string('use_studentid', 'local_studentid'); ?>
        </label>
    </div>
    <div>
        <label for="student_id_format"><?php echo get_string('student_id_format', 'local_studentid'); ?></label>
        <input type="text" name="student_id_format" id="student_id_format" value="<?php echo htmlspecialchars($student_id_format); ?>" />
        <?php echo $OUTPUT->help_icon('student_id_format', 'local_studentid'); ?>
    </div>
    <div>
        <input type="submit" value="<?php echo get_string('submit', 'local_studentid'); ?>" />
    </div>
</form>

<?php
echo $OUTPUT->footer();