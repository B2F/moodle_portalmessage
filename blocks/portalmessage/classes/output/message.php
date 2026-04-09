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

    /** @var string */
    private $messagetype;

    /** @var int */
    private $messageversion;

    /** @var string */
    private $containerid;

    /** @var string */
    private $dismisslabel;

    /**
     * Constructor.
     *
     * @param string $message Portal message text.
     * @param string $messagetype Message presentation type.
     * @param int $messageversion Current message version.
     * @param string $containerid DOM id used by AMD initialization.
     * @param string $dismisslabel Localized dismiss button label.
     */
    public function __construct(
        string $message,
        string $messagetype = 'info',
        int $messageversion = 1,
        string $containerid = '',
        string $dismisslabel = ''
    ) {
        $this->message = $message;
        $this->messagetype = in_array($messagetype, ['info', 'warning']) ? $messagetype : 'info';
        $this->messageversion = max(1, $messageversion);
        $this->containerid = $containerid;
        $this->dismisslabel = $dismisslabel;
    }

    /**
     * Export context for the template.
     *
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output): array {
        $iswarning = $this->messagetype === 'warning';

        return [
            'message' => $this->message,
            'messagetype' => $this->messagetype,
            'messageversion' => $this->messageversion,
            'containerid' => $this->containerid,
            'dismisslabel' => $this->dismisslabel,
            'iswarning' => $iswarning,
            'typeclass' => 'block-portalmessage--' . $this->messagetype,
            'ariarole' => $iswarning ? 'alert' : 'status',
        ];
    }
}
