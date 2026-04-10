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

namespace block_portalmessage\output;

/**
 * Tests for portal message template export formatting.
 *
 * @package    block_portalmessage
 * @category   test
 * @copyright  2026
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversNothing
 */
final class message_test extends \advanced_testcase {
    public function test_plain_text_message_still_renders_after_formatting(): void {
        $this->resetAfterTest();

        $message = new message('Portal update for all users.');
        $data = $message->export_for_template($this->get_block_renderer());

        $this->assertStringContainsString('Portal update for all users.', strip_tags($data['message']));
    }

    public function test_multilang_message_filters_and_falls_back_to_first_variant(): void {
        global $CFG;

        $this->resetAfterTest();

        $CFG->stringfilters = 'multilang';
        filter_set_global_state('multilang', TEXTFILTER_ON);
        filter_set_applies_to_strings('multilang', true);

        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);
        force_current_language('es');

        $message = new message(
            '<span lang="en" class="multilang">English portal message</span>' .
            '<span lang="fr" class="multilang">Message portail francais</span>'
        );

        $data = $message->export_for_template($this->get_block_renderer());

        $this->assertStringContainsString('English portal message', strip_tags($data['message']));
        $this->assertStringNotContainsString('Message portail francais', strip_tags($data['message']));
    }

    /**
     * Create renderer for block template export.
     *
     * @return mixed
     */
    private function get_block_renderer() {
        $page = new \moodle_page();
        $page->set_context(\context_system::instance());

        return $page->get_renderer('block_portalmessage');
    }
}
