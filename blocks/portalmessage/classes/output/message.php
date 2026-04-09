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

defined('MOODLE_INTERNAL') || die();

/**
 * Renderable for portal message block output.
 */
class message implements \renderable, \templatable {
    /** @var string */
    private $message;

    /**
     * Constructor.
     *
     * @param string $message Portal message text.
     */
    public function __construct(string $message) {
        $this->message = $message;
    }

    /**
     * Export context for the template.
     *
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output): array {
        return [
            'message' => $this->message,
        ];
    }
}
