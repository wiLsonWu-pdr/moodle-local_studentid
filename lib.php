<?php
defined('MOODLE_INTERNAL') || die();

function generate_student_id($string, $userid, $createdDate) {
    
    $year = date('Y', $createdDate);
    $month = date('m', $createdDate);
    $day = date('d', $createdDate);

    return $string . $year . $month . $day . $userid;
}