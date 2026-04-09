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
 * Tests for the portal message configuration service.
 *
 * @package     local_portalmessage
 * @category    test
 */
final class configuration_test extends \advanced_testcase {
    public function test_version_changes_when_message_content_changes(): void {
        $service = new configuration();

        $current = (object) [
            'enabled' => 1,
            'message' => 'Portal message',
            'messagetype' => 'info',
            'targetcapability' => 'moodle/site:config',
            'messageversion' => 2,
        ];

        $unchanged = (object) [
            'enabled' => 1,
            'message' => 'Portal message',
            'messagetype' => 'info',
            'targetcapability' => 'moodle/site:config',
            'messageversion' => 2,
        ];

        $changed = (object) [
            'enabled' => 1,
            'message' => 'Updated portal message',
            'messagetype' => 'info',
            'targetcapability' => 'moodle/site:config',
            'messageversion' => 2,
        ];

        $this->assertFalse($service->requires_version_bump($current, $unchanged));
        $this->assertTrue($service->requires_version_bump($current, $changed));
        $this->assertSame(2, $service->next_message_version($current, $unchanged));
        $this->assertSame(3, $service->next_message_version($current, $changed));
    }
}
