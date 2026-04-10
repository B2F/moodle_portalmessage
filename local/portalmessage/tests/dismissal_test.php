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

/**
 * Tests for portal message dismissal preference behavior.
 *
 * @package     local_portalmessage
 * @category    test
 * @copyright   2026
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversNothing
 */
final class dismissal_test extends \advanced_testcase {
    public function test_dismissed_message_version_is_persisted_for_user(): void {
        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();

        $service = new dismissal();

        $this->assertSame(0, $service->get_dismissed_message_version((int) $user->id));
        $this->assertFalse($service->is_message_dismissed_for_user((int) $user->id, 1));

        $service->dismiss_message_version((int) $user->id, 2);

        $this->assertSame(2, $service->get_dismissed_message_version((int) $user->id));
        $this->assertTrue($service->is_message_dismissed_for_user((int) $user->id, 2));
    }

    public function test_banner_is_not_treated_as_dismissed_after_message_version_changes(): void {
        $this->resetAfterTest();

        $user = $this->getDataGenerator()->create_user();
        $service = new dismissal();

        set_config('messageversion', 3, 'local_portalmessage');
        $service->dismiss_message_version((int) $user->id, 3);

        $this->assertTrue($service->is_message_dismissed_for_user((int) $user->id, 3));

        set_config('messageversion', 4, 'local_portalmessage');

        $this->assertFalse($service->is_message_dismissed_for_user((int) $user->id, 4));
    }
}
