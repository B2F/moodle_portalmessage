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

/**
 * Return installed languages used for portal message editor fields.
 *
 * @return array Language code => language name.
 */
function local_portalmessage_get_installed_languages(): array {
    $languages = get_string_manager()->get_list_of_translations(false);
    if (empty($languages)) {
        return ['en' => 'English'];
    }

    return $languages;
}

/**
 * Build config key suffix for language-specific message settings.
 *
 * @param string $languagecode
 * @return string
 */
function local_portalmessage_language_setting_suffix(string $languagecode): string {
    $languagecode = strtolower(trim($languagecode));
    return preg_replace('/[^a-z0-9_]/', '_', $languagecode);
}

/**
 * Normalize editor HTML and remove accidental admin default-info wrappers.
 *
 * @param string $content
 * @return string
 */
function local_portalmessage_normalize_editor_content(string $content): string {
    $content = trim($content);
    if ($content === '') {
        return '';
    }

    $matches = [];
    if (preg_match('/^<div[^>]*class="[^"]*form-defaultinfo[^"]*"[^>]*>(.*?)<\/div>$/is', $content, $matches)) {
        return trim((string) ($matches[1] ?? ''));
    }

    return $content;
}

/**
 * Resolve the portal message for the current language.
 *
 * @return string
 */
function local_portalmessage_get_current_language_message(): string {
    $config = get_config('local_portalmessage');

    $currentlanguage = strtolower((string) current_language());
    $candidates = [$currentlanguage];
    if (strpos($currentlanguage, '_') !== false) {
        $candidates[] = explode('_', $currentlanguage)[0];
    }
    if (!in_array('en', $candidates, true)) {
        $candidates[] = 'en';
    }

    foreach ($candidates as $languagecode) {
        $settingname = 'message_' . local_portalmessage_language_setting_suffix((string) $languagecode);
        if (!empty($config->{$settingname})) {
            return local_portalmessage_normalize_editor_content((string) $config->{$settingname});
        }
    }

    foreach (array_keys(local_portalmessage_get_installed_languages()) as $languagecode) {
        $settingname = 'message_' . local_portalmessage_language_setting_suffix((string) $languagecode);
        if (!empty($config->{$settingname})) {
            return local_portalmessage_normalize_editor_content((string) $config->{$settingname});
        }
    }

    return isset($config->message) ? (string) $config->message : '';
}

/**
 * Synchronize per-language editor values into the canonical message config.
 */
function local_portalmessage_sync_multilang_message(): void {
    $config = get_config('local_portalmessage');
    $service = new \local_portalmessage\service\configuration();
    $installedlanguages = local_portalmessage_get_installed_languages();

    $messages = $service->extract_multilang_messages((string) ($config->message ?? ''));

    foreach (array_keys($installedlanguages) as $languagecode) {
        $settingsuffix = local_portalmessage_language_setting_suffix((string) $languagecode);
        $settingname = 'message_' . $settingsuffix;

        if (property_exists($config, $settingname)) {
            $messages[strtolower((string) $languagecode)] =
                local_portalmessage_normalize_editor_content((string) ($config->{$settingname} ?? ''));
        }
    }

    $message = $service->compose_multilang_message($messages);

    set_config('message', $message, 'local_portalmessage');
}
