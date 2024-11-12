<?php
//defined('MOODLE_INTERNAL') || die();

//require_once($CFG->dirroot.'/user/editadvanced_form.php');

//class local_studentid_user_edit_form extends user_editadvanced_form  {
    /**
     * 定義表單。
     */
//    public function definition() {
//        parent::definition(); // 調用父類的定義

//        $mform = $this->_form;
//
        // 添加選擇框，讓用戶選擇是否使用學生ID作為用戶名
//        $mform->addElement('checkbox', 'use_studentid', get_string('use_studentid', 'local_studentid'));
//        $mform->setDefault('use_studentid', 0); // 默認為未選中
//        $mform->addHelpButton('newcheckbox', 'newcheckbox', 'local_yourplugin');

        // 添加 JavaScript
        /*global $PAGE;
        $PAGE->requires->js('/local/studentid/amd/src/disable_username.js');
        $PAGE->requires->js_init_call('local_studentid.init');*/
//    }
//}