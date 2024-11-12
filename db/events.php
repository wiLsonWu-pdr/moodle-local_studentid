<?php
defined('MOODLE_INTERNAL') || die();

$observers = array(

    array(
        'eventname' => '\core\event\user_created',
        'callback' => 'local_studentid_observer::user_created',
    ),
);
