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

/**
 * @package   local_studentid
 * @copyright 2024 WiLsonWu
 * @author    WiLsonWu
 */

defined('MOODLE_INTERNAL') || die;


$url = new moodle_url( '/local/studentid/index.php' );
$ADMIN->add( 'localplugins', new admin_externalpage('studentid',
                                                       get_string('student_id_generate_setting',
                                                       'local_studentid'), $url, 'local/studentid:manage'));
