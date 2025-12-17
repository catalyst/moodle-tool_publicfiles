<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Version.
 *
 * @package   tool_publicfiles
 * @author    Brendan Heywood <brendan@catalyst-au.net>
 * @copyright 2025, Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('tool_publicfiles', get_string('publicfiles', 'tool_publicfiles'));

    $settings->add(new admin_setting_configstoredfile('tool_publicfiles/files',
        get_string('publicfiles', 'tool_publicfiles'),
        get_string('publicfiles_desc', 'tool_publicfiles'),
        'files',
        0,
        [
            'maxfiles' => -1,
            'accepted_types' => '*',
        ]));

    // Preview table of public URLs.
    $settings->add(new admin_setting_heading(
        'tool_publicfiles/previewheading',
        get_string('publicfiles', 'tool_publicfiles'),
        \tool_publicfiles\files_table::render()
    ));

    $ADMIN->add('tools', $settings);
}
