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

    public function test_compose_multilang_message_creates_adjacent_lang_spans(): void {
        $service = new configuration();

        $actual = $service->compose_multilang_message([
            'en' => '<p>English</p>',
            'fr' => '<p>Francais</p>',
            'es' => '',
        ]);

        $this->assertStringContainsString('<span lang="en" class="multilang"><p>English</p></span>', $actual);
        $this->assertStringContainsString('<span lang="fr" class="multilang"><p>Francais</p></span>', $actual);
        $this->assertStringNotContainsString('lang="es"', $actual);
    }

    public function test_extract_multilang_messages_returns_per_language_content(): void {
        $service = new configuration();

        $message = '<span lang="en" class="multilang">English</span>' .
            '<span class="multilang" lang="fr">Francais</span>';

        $actual = $service->extract_multilang_messages($message);

        $this->assertSame('English', $actual['en']);
        $this->assertSame('Francais', $actual['fr']);
    }
}
