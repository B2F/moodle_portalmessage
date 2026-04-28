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
 * Tests for message version admin setting behavior.
 *
 * @package     local_portalmessage
 * @category    test
 * @copyright   2026
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversNothing
 */
final class messageversion_setting_test extends \advanced_testcase {
    public function test_setting_is_read_only(): void {
        $setting = new messageversion(
            'local_portalmessage/messageversion',
            'Message version',
            'Version',
            1,
            PARAM_INT
        );

        $this->assertTrue($setting->is_readonly());
    }

    public function test_validate_rejects_downgrade_and_accepts_equal_or_higher(): void {
        $this->resetAfterTest();

        set_config('messageversion', 4, 'local_portalmessage');

        $setting = new messageversion(
            'local_portalmessage/messageversion',
            'Message version',
            'Version',
            1,
            PARAM_INT
        );

        $this->assertIsString($setting->validate('3'));
        $this->assertTrue($setting->validate('4'));
        $this->assertTrue($setting->validate('5'));
    }
}
