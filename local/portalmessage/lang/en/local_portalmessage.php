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

/**
 * Strings for component 'local_portalmessage', language 'en'.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['enabled'] = 'Enabled';
$string['enabled_desc'] = 'Show the portal message block when enabled.';
$string['message'] = 'Message text';
$string['message_desc'] = 'The text shown in the portal message banner.';
$string['message_en'] = 'Message (English)';
$string['message_es'] = 'Message (Spanish)';
$string['message_fr'] = 'Message (French)';
$string['message_lang_desc'] = 'Content shown for users with preferred language {$a}.';
$string['message_language'] = 'Message ({$a})';
$string['message_multilang_desc'] = '<br><br>For multilingual content, enable the multilang filter and use spans like:<br><pre><code>&lt;span lang="en" class="multilang"&gt;English text&lt;/span&gt;\n&lt;span lang="fr" class="multilang"&gt;Texte francais&lt;/span&gt;</code></pre>';
$string['messagetype'] = 'Message type';
$string['messagetype_desc'] = 'Choose the presentation style for the portal message.';
$string['messagetype_info'] = 'Info';
$string['messagetype_warning'] = 'Warning';
$string['messageversion'] = 'Message version';
$string['messageversion_desc'] = 'Increment this when the message content changes so dismissals are reset.';
$string['pluginname'] = 'Portal message';
$string['portalmessage:viewmessage'] = 'View portal message block content';
$string['privacy:metadata:dismissedmessageversion'] = 'Stores the last portal message version dismissed by the user.';
$string['showalllanguages'] = 'Show all language editors';
$string['showalllanguages_desc'] = 'By default only your active language ({$a}) editor is shown. Enable this to expand editors for all configured languages.';
$string['targetcapability'] = 'Target capability';
$string['targetcapability_courseupdate'] = 'Teachers and managers (moodle/course:update)';
$string['targetcapability_courseview'] = 'All enrolled learners and staff (moodle/course:view)';
$string['targetcapability_custom'] = 'Custom capability (current value): {$a}';
$string['targetcapability_desc'] = 'Only users with this capability can see the portal message.';
$string['targetcapability_manageblocks'] = 'Users who can manage blocks (moodle/site:manageblocks)';
$string['targetcapability_portalmessageviewer'] = 'Portal message viewers (local/portalmessage:viewmessage)';
$string['targetcapability_siteconfig'] = 'Site administrators (moodle/site:config)';
