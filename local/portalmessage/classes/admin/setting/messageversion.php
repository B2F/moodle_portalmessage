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

namespace local_portalmessage\admin\setting;

/**
 * Message version setting that prevents version downgrades.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class messageversion extends \admin_setting_configtext {
    /**
     * Keep this setting read-only in admin UI.
     *
     * @return bool
     */
    public function is_readonly(): bool {
        return true;
    }

    /**
     * Validate the submitted value.
     *
     * @param mixed $data
     * @return bool|string
     */
    public function validate($data) {
        $result = parent::validate($data);
        if ($result !== true) {
            return $result;
        }

        $newversion = max(1, (int) $data);
        $currentversion = (int) get_config('local_portalmessage', 'messageversion');
        if ($newversion < max(1, $currentversion)) {
            return get_string('messageversion_cannotdowngrade', 'local_portalmessage', $currentversion);
        }

        return true;
    }
}
