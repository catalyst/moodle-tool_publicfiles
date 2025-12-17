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
 * Shows a table of files
 *
 * @package   tool_publicfiles
 * @author    Brendan Heywood <brendan@catalyst-au.net>
 * @copyright 2025, Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_publicfiles;

/**
 * Shows a table of files
 *
 * @package tool_publicfiles
 */
class files_table {

    /**
     * Shows a table of files
     */
    public static function render(): string {
        global $CFG;

        $context = \context_system::instance();
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'tool_publicfiles', 'files', 0, 'filepath, filename', false);

        if (empty($files)) {
            return \html_writer::div(get_string('none'), 'alert alert-info');
        }

        $table = new \html_table();
        $table->head = ['Filename', 'Public URL'];
        $table->data = [];

        foreach ($files as $file) {
            $url = \moodle_url::make_pluginfile_url(
                $context->id,
                'tool_publicfiles',
                'files',
                0,
                $file->get_filepath(),
                $file->get_filename()
            );

            $table->data[] = [
                s($file->get_filename()),
                \html_writer::link($url, $url),
            ];
        }

        return \html_writer::table($table);
    }
}
