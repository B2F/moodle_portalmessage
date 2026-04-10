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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/portalmessage/lib.php');

use block_portalmessage\output\message;
use local_portalmessage\service\configuration;
use local_portalmessage\service\dismissal;

/**
 * Portal message block implementation.
 *
 * @package   block_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_portalmessage extends block_base {
    /**
     * Initialise block title.
     */
    public function init(): void {
        $this->title = get_string('pluginname', 'block_portalmessage');
    }

    /**
     * Restrict supported page formats.
     *
     * @return array
     */
    public function applicable_formats(): array {
        return [
            'site' => true,
            'my' => true,
        ];
    }

    /**
     * Build block content when portal message is visible.
     *
     * @return stdClass|null
     */
    public function get_content() {
        global $USER;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            return null;
        }

        $configurationservice = new configuration();
        $configuration = $configurationservice->get_configuration();

        $messagetext = local_portalmessage_get_current_language_message();
        if (!$configuration->enabled || trim($messagetext) === '') {
            return null;
        }

        $targetcapability = trim((string) $configuration->targetcapability);
        $context = $this->page->context ?? \context_system::instance();
        if ($targetcapability !== '' && !has_capability($targetcapability, $context)) {
            return null;
        }

        $dismissalservice = new dismissal();
        $messageversion = max(1, (int) $configuration->messageversion);
        if (isloggedin() && !isguestuser() && $dismissalservice->is_message_dismissed_for_user((int) $USER->id, $messageversion)) {
            return null;
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        $containerid = 'block-portalmessage-message-' . $this->instance->id;

        $renderable = new message(
            $messagetext,
            $configuration->messagetype,
            $messageversion,
            $containerid,
            get_string('closebuttontitle', 'moodle')
        );
        $renderer = $this->page->get_renderer('block_portalmessage');
        $this->content->text = $renderer->render_message($renderable);
        $this->page->requires->js_call_amd('block_portalmessage/dismiss', 'init', [$containerid]);

        return $this->content;
    }
}
