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

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_portalmessage', get_string('pluginname', 'local_portalmessage'));

    if ($ADMIN->fulltree) {
        $settings->add(new admin_setting_configcheckbox(
            'local_portalmessage/enabled',
            get_string('enabled', 'local_portalmessage'),
            get_string('enabled_desc', 'local_portalmessage'),
            1
        ));

        $settings->add(new admin_setting_configtextarea(
            'local_portalmessage/message',
            get_string('message', 'local_portalmessage'),
            get_string('message_desc', 'local_portalmessage') . ' ' . get_string('message_multilang_desc', 'local_portalmessage'),
            ''
        ));

        $settings->add(new admin_setting_configselect(
            'local_portalmessage/messagetype',
            get_string('messagetype', 'local_portalmessage'),
            get_string('messagetype_desc', 'local_portalmessage'),
            'info',
            [
                'info' => get_string('messagetype_info', 'local_portalmessage'),
                'warning' => get_string('messagetype_warning', 'local_portalmessage'),
            ]
        ));

        $commoncapabilities = [
            'local/portalmessage:viewmessage' => get_string('targetcapability_portalmessageviewer', 'local_portalmessage'),
            'moodle/site:config' => get_string('targetcapability_siteconfig', 'local_portalmessage'),
            'moodle/site:manageblocks' => get_string('targetcapability_manageblocks', 'local_portalmessage'),
            'moodle/course:update' => get_string('targetcapability_courseupdate', 'local_portalmessage'),
            'moodle/course:view' => get_string('targetcapability_courseview', 'local_portalmessage'),
        ];

        $currenttargetcapability = (string) get_config('local_portalmessage', 'targetcapability');
        if ($currenttargetcapability !== '' && !array_key_exists($currenttargetcapability, $commoncapabilities)) {
            $commoncapabilities[$currenttargetcapability] =
                get_string('targetcapability_custom', 'local_portalmessage', $currenttargetcapability);
        }

        $settings->add(new admin_setting_configselect(
            'local_portalmessage/targetcapability',
            get_string('targetcapability', 'local_portalmessage'),
            get_string('targetcapability_desc', 'local_portalmessage'),
            'moodle/site:config',
            $commoncapabilities
        ));

        $settings->add(new admin_setting_configtext(
            'local_portalmessage/messageversion',
            get_string('messageversion', 'local_portalmessage'),
            get_string('messageversion_desc', 'local_portalmessage'),
            1,
            PARAM_INT
        ));
    }

    $ADMIN->add('localplugins', $settings);
}
