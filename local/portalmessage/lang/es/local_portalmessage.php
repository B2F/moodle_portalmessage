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
 * Strings for component 'local_portalmessage', language 'es'.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['enabled'] = 'Activado';
$string['enabled_desc'] = 'Muestra el bloque de mensaje del portal cuando esta activado.';
$string['message'] = 'Texto del mensaje';
$string['message_desc'] = 'El texto que se muestra en el aviso del portal.';
$string['message_en'] = 'Mensaje (Ingles)';
$string['message_es'] = 'Mensaje (Espanol)';
$string['message_fr'] = 'Mensaje (Frances)';
$string['message_lang_desc'] = 'Contenido mostrado para usuarios con idioma preferido {$a}.';
$string['message_language'] = 'Mensaje ({$a})';
$string['message_multilang_desc'] = '<br><br>Para contenido multilingue, activa el filtro multilang y usa etiquetas como:<br><pre><code>&lt;span lang="en" class="multilang"&gt;English text&lt;/span&gt;\n&lt;span lang="fr" class="multilang"&gt;Texte francais&lt;/span&gt;</code></pre>';
$string['messagetype'] = 'Tipo de mensaje';
$string['messagetype_desc'] = 'Elige el estilo de presentacion para el mensaje del portal.';
$string['messagetype_info'] = 'Informacion';
$string['messagetype_warning'] = 'Advertencia';
$string['messageversion'] = 'Version del mensaje';
$string['messageversion_desc'] = 'Incrementa este valor cuando el contenido cambie para reiniciar descartes.';
$string['pluginname'] = 'Mensaje del portal';
$string['portalmessage:viewmessage'] = 'Ver el contenido del bloque de mensaje del portal';
$string['privacy:metadata:dismissedmessageversion'] = 'Guarda la ultima version del mensaje del portal descartada por el usuario.';
$string['showalllanguages'] = 'Mostrar todos los editores de idioma';
$string['showalllanguages_desc'] = 'Por defecto solo se muestra el editor de tu idioma activo ({$a}). Activa esta opcion para expandir los editores de todos los idiomas configurados.';
$string['targetcapability'] = 'Capacidad objetivo';
$string['targetcapability_courseupdate'] = 'Profesores y gestores (moodle/course:update)';
$string['targetcapability_courseview'] = 'Todo el alumnado y personal inscrito (moodle/course:view)';
$string['targetcapability_custom'] = 'Capacidad personalizada (valor actual): {$a}';
$string['targetcapability_desc'] = 'Solo los usuarios con esta capacidad pueden ver el mensaje del portal.';
$string['targetcapability_manageblocks'] = 'Usuarios que pueden gestionar bloques (moodle/site:manageblocks)';
$string['targetcapability_portalmessageviewer'] = 'Usuarios del mensaje del portal (local/portalmessage:viewmessage)';
$string['targetcapability_siteconfig'] = 'Administradores del sitio (moodle/site:config)';
