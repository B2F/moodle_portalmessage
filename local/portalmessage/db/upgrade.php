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
 * Upgrade steps for local_portalmessage.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_portalmessage_upgrade($oldversion) {
    global $CFG;

    require_once($CFG->libdir . '/filterlib.php');
    require_once($CFG->dirroot . '/local/portalmessage/lib.php');

    if ($oldversion < 2025100603) {
        // Ensure multilang filtering is enabled for portal message translations.
        filter_set_global_state('multilang', TEXTFILTER_ON);

        upgrade_plugin_savepoint(true, 2025100603, 'local', 'portalmessage');
    }

    if ($oldversion < 2025100604) {
        $config = get_config('local_portalmessage');
        foreach (array_keys(local_portalmessage_get_installed_languages()) as $languagecode) {
            $settingname = 'message_' . local_portalmessage_language_setting_suffix((string) $languagecode);
            if (!property_exists($config, $settingname)) {
                continue;
            }

            $normalized = local_portalmessage_normalize_editor_content((string) ($config->{$settingname} ?? ''));
            set_config($settingname, $normalized, 'local_portalmessage');
        }

        local_portalmessage_sync_multilang_message();

        upgrade_plugin_savepoint(true, 2025100604, 'local', 'portalmessage');
    }

    return true;
}
