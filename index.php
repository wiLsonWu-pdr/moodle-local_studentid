<?php
// 這段代碼保留了原有的 Moodle 設置和引入
require_once(dirname(__FILE__).'/../../config.php');
require_login();

echo $OUTPUT->header();
echo $OUTPUT->heading('Statistical Report');

echo $OUTPUT->footer();