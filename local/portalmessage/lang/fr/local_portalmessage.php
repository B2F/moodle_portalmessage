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
 * Strings for component 'local_portalmessage', language 'fr'.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['enabled'] = 'Active';
$string['enabled_desc'] = 'Affiche le bloc de message du portail lorsqu il est active.';
$string['message'] = 'Texte du message';
$string['message_desc'] = 'Le texte affiche dans la banniere du message du portail.';
$string['message_en'] = 'Message (Anglais)';
$string['message_es'] = 'Message (Espagnol)';
$string['message_fr'] = 'Message (Francais)';
$string['message_lang_desc'] = 'Contenu affiche pour les utilisateurs avec la langue preferee {$a}.';
$string['message_language'] = 'Message ({$a})';
$string['message_multilang_desc'] = '<br><br>Pour du contenu multilingue, activez le filtre multilang et utilisez des balises comme :<br><pre><code>&lt;span lang="en" class="multilang"&gt;English text&lt;/span&gt;\n&lt;span lang="fr" class="multilang"&gt;Texte francais&lt;/span&gt;</code></pre>';
$string['messagetype'] = 'Type de message';
$string['messagetype_desc'] = 'Choisissez le style de presentation du message du portail.';
$string['messagetype_info'] = 'Information';
$string['messagetype_warning'] = 'Alerte';
$string['messageversion'] = 'Version du message';
$string['messageversion_desc'] = 'Incrementez cette valeur quand le contenu change pour reinitialiser les fermetures.';
$string['pluginname'] = 'Message du portail';
$string['portalmessage:viewmessage'] = 'Voir le contenu du bloc de message du portail';
$string['privacy:metadata:dismissedmessageversion'] = 'Stocke la derniere version du message du portail fermee par l utilisateur.';
$string['showalllanguages'] = 'Afficher tous les editeurs de langue';
$string['showalllanguages_desc'] = 'Par defaut seul l editeur de votre langue active ({$a}) est affiche. Activez cette option pour afficher les editeurs de toutes les langues configurees.';
$string['targetcapability'] = 'Capacite cible';
$string['targetcapability_courseupdate'] = 'Enseignants et gestionnaires (moodle/course:update)';
$string['targetcapability_courseview'] = 'Tous les apprenants et personnels inscrits (moodle/course:view)';
$string['targetcapability_custom'] = 'Capacite personnalisee (valeur actuelle) : {$a}';
$string['targetcapability_desc'] = 'Seuls les utilisateurs avec cette capacite peuvent voir le message du portail.';
$string['targetcapability_manageblocks'] = 'Utilisateurs qui peuvent gerer les blocs (moodle/site:manageblocks)';
$string['targetcapability_portalmessageviewer'] = 'Lecteurs du message portail (local/portalmessage:viewmessage)';
$string['targetcapability_siteconfig'] = 'Administrateurs du site (moodle/site:config)';
