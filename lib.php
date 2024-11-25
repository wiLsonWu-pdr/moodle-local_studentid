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
 * Library functions for the local_studentid plugin.
 *
 * This file contains functions related to student ID generation.
 *
 * @package   local_studentid
 * @copyright 2024 WiLsonWu
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    WiLson Wu
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Generate a student ID based on the provided string, user ID, and creation date.
 *
 * @param string $string The base string for the student ID.
 * @param int $userid The user ID.
 * @param int $createddate The timestamp of the creation date.
 * @return string The generated student ID.
 */
function generate_student_id($string, $userid, $createddate) {
    $year = date('Y', $createddate);
    $month = date('m', $createddate);
    $day = date('d', $createddate);

    return $string . $year . $month . $day . $userid;
}