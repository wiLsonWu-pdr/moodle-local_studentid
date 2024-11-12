<?php
defined('MOODLE_INTERNAL') || die();

function generate_student_id($string, $userid, $createdDate) {
    // 获取创建日期的年份、月份和日期
    $year = date('Y', $createdDate);
    $month = date('m', $createdDate);
    $day = date('d', $createdDate);

    // 生成 studentid
    return $string . $year . $month . $day . $userid;
}