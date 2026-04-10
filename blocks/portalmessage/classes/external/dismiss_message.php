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

namespace block_portalmessage\external;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use local_portalmessage\service\configuration;
use local_portalmessage\service\dismissal;

/**
 * Web service for dismissing the portal message.
 *
 * @package   block_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class dismiss_message extends external_api {
    /**
     * Describe input parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'messageversion' => new external_value(PARAM_INT, 'The visible portal message version to dismiss.'),
        ]);
    }

    /**
     * Persist dismissal preference for the current user.
     *
     * @param int $messageversion
     * @return array
     */
    public static function execute(int $messageversion): array {
        global $USER;

        ['messageversion' => $messageversion] = self::validate_parameters(self::execute_parameters(), [
            'messageversion' => $messageversion,
        ]);

        require_login();

        $context = \context_system::instance();
        self::validate_context($context);

        $configurationservice = new configuration();
        $config = $configurationservice->get_configuration();
        $targetcapability = trim((string) $config->targetcapability);
        if ($targetcapability !== '') {
            require_capability($targetcapability, $context);
        }

        $dismissalservice = new dismissal();
        $dismissalservice->dismiss_message_version((int) $USER->id, max(1, (int) $messageversion));

        return [
            'status' => true,
        ];
    }

    /**
     * Describe return values.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'status' => new external_value(PARAM_BOOL, 'Whether the dismissal request was persisted.'),
        ]);
    }
}
