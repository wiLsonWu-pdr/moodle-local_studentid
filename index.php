<?php

require_once(dirname(__FILE__).'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');

require_login();

admin_externalpage_setup('managelocalplugins');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('student_id_generate_setting', 'local_studentid'));

// 如果请求方法为 POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $use_student_id = isset($_POST['use_student_id']) ? true : false;
    
    // 获取用户输入的字符串，如果为空则使用默认值 's'
    $student_id_format = isset($_POST['student_id_format']) ? trim($_POST['student_id_format']) : 's';

    // 保存设置到用户偏好中
    set_user_preference('use_student_id', $use_student_id);
    set_user_preference('student_id_format', $student_id_format);

    echo $OUTPUT->notification(get_string('setting_have_been_saved', 'local_studentid'), 'notifymessage');
}

// 获取用户偏好设置
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