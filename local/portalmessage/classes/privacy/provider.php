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

namespace local_portalmessage\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\writer;
use local_portalmessage\service\dismissal;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy provider for portal message dismissal preference data.
 */
class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\user_preference_provider {
    /**
     * Return metadata about stored user data.
     *
     * @param collection $collection
     * @return collection
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_user_preference(
            dismissal::PREFERENCE_KEY,
            'privacy:metadata:dismissedmessageversion'
        );

        return $collection;
    }

    /**
     * Export user preference values.
     *
     * @param int $userid
     */
    public static function export_user_preferences(int $userid): void {
        $dismissedversion = get_user_preferences(dismissal::PREFERENCE_KEY, null, $userid);
        if ($dismissedversion === null) {
            return;
        }

        writer::export_user_preference(
            'local_portalmessage',
            dismissal::PREFERENCE_KEY,
            (int) $dismissedversion,
            get_string('privacy:metadata:dismissedmessageversion', 'local_portalmessage')
        );
    }
}
