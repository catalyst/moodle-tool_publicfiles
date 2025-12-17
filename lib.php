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

/**
 * Plugin file
 *
 * @package   tool_publicfiles
 * @category    files
 *
 * @param stdClass $course The course object.
 * @param stdClass $cm The course module object.
 * @param stdClass $context The mod_subsection's context.
 * @param string $filearea The name of the file area.
 * @param array $args Extra arguments (itemid, path).
 * @param bool $forcedownload Whether or not force download.
 * @param array $options Additional options affecting the file serving.
 */
function tool_publicfiles_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    // Only system context is valid.
    if ($context->contextlevel !== CONTEXT_SYSTEM) {
        return false;
    }

    if ($filearea !== 'files') {
        return false;
    }

    $fs = get_file_storage();
    $filename = array_pop($args);
    $file = $fs->get_file($context->id, 'tool_publicfiles', 'files', 0, '/', $filename);

    if (!$file || $file->is_directory()) {
        return false;
    }

    // CDN‑friendly cache headers (1 year, immutable).
    $lifetime = 60 * 60 * 24 * 365;

    $options['cacheability'] = 'public';
    $options['expires'] = time() + $lifetime;
    $options['immutable'] = true;

    send_stored_file($file, $lifetime, 0, false, $options);
}
