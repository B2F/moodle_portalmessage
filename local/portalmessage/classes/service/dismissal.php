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

namespace local_portalmessage\service;

defined('MOODLE_INTERNAL') || die();

/**
 * Service for portal message dismissal user preference handling.
 */
class dismissal {
    /** @var string User preference key for dismissed portal message version. */
    public const PREFERENCE_KEY = 'local_portalmessage_dismissedmessageversion';

    /**
     * Persist the dismissed portal message version for a user.
     *
     * @param int $userid The user id.
     * @param int $messageversion The dismissed message version.
     */
    public function dismiss_message_version(int $userid, int $messageversion): void {
        set_user_preference(self::PREFERENCE_KEY, (string) $messageversion, $userid);
    }

    /**
     * Get the stored dismissed portal message version for a user.
     *
     * @param int $userid The user id.
     * @return int
     */
    public function get_dismissed_message_version(int $userid): int {
        return (int) get_user_preferences(self::PREFERENCE_KEY, 0, $userid);
    }

    /**
     * Check if the current portal message version was dismissed by a user.
     *
     * @param int $userid The user id.
     * @param int $messageversion The current message version.
     * @return bool
     */
    public function is_message_dismissed_for_user(int $userid, int $messageversion): bool {
        return $this->get_dismissed_message_version($userid) === $messageversion;
    }
}
