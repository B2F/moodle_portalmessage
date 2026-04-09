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

class block_portalmessage extends block_base {
    public function init(): void {
        $this->title = get_string('pluginname', 'block_portalmessage');
    }

    public function applicable_formats(): array {
        return ['site' => true];
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        $configurationservice = new \local_portalmessage\service\configuration();
        $configuration = $configurationservice->get_configuration();

        if (!$configuration->enabled || trim($configuration->message) === '') {
            return $this->content;
        }

        $renderable = new \block_portalmessage\output\message($configuration->message);
        $renderer = $this->page->get_renderer('block_portalmessage');
        $this->content->text = $renderer->render_message($renderable);

        return $this->content;
    }
}
