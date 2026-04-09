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

$string['pluginname'] = 'Portal message';
$string['enabled'] = 'Enabled';
$string['enabled_desc'] = 'Show the portal message block when enabled.';
$string['message'] = 'Message text';
$string['message_desc'] = 'The text shown in the portal message banner.';
$string['message_multilang_desc'] = 'For multilingual content, enable the multilang filter and use spans like <span lang="en" class="multilang">English text</span><span lang="fr" class="multilang">Texte francais</span>.';
$string['messageversion'] = 'Message version';
$string['messageversion_desc'] = 'Increment this when the message content changes so dismissals are reset.';
$string['messagetype'] = 'Message type';
$string['messagetype_desc'] = 'Choose the presentation style for the portal message.';
$string['messagetype_info'] = 'Info';
$string['messagetype_warning'] = 'Warning';
$string['privacy:metadata:dismissedmessageversion'] = 'Stores the last portal message version dismissed by the user.';
$string['portalmessage:viewmessage'] = 'View portal message block content';
$string['targetcapability'] = 'Target capability';
$string['targetcapability_desc'] = 'Only users with this capability can see the portal message.';
$string['targetcapability_courseupdate'] = 'Teachers and managers (moodle/course:update)';
$string['targetcapability_courseview'] = 'All enrolled learners and staff (moodle/course:view)';
$string['targetcapability_custom'] = 'Custom capability (current value): {$a}';
$string['targetcapability_manageblocks'] = 'Users who can manage blocks (moodle/site:manageblocks)';
$string['targetcapability_portalmessageviewer'] = 'Portal message viewers (local/portalmessage:viewmessage)';
$string['targetcapability_siteconfig'] = 'Site administrators (moodle/site:config)';
