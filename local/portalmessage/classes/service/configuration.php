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

namespace local_portalmessage\service;

/**
 * Reads portal message configuration and applies versioning rules.
 *
 * @package   local_portalmessage
 * @copyright 2026
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class configuration {
    /**
     * Return the current plugin configuration with defaults applied.
     *
     * @return object
     */
    public function get_configuration(): object {
        $config = get_config('local_portalmessage');

        return (object) [
            'enabled' => isset($config->enabled) ? (!empty($config->enabled) ? 1 : 0) : 1,
            'message' => isset($config->message) ? (string) $config->message : '',
            'messagetype' => isset($config->messagetype) ? (string) $config->messagetype : 'info',
            'targetcapability' => isset($config->targetcapability) ? (string) $config->targetcapability : 'moodle/site:config',
            'messageversion' => isset($config->messageversion) ? (int) $config->messageversion : 1,
        ];
    }

    /**
     * Build a multilang message value from per-language HTML content.
     *
     * @param array $messages Language code => HTML content.
     * @return string
     */
    public function compose_multilang_message(array $messages): string {
        $parts = [];

        foreach ($messages as $language => $content) {
            $language = trim((string) $language);
            $content = trim((string) $content);

            if ($language === '' || $content === '') {
                continue;
            }

            $parts[] = '<span lang="' . s($language) . '" class="multilang">' . $content . '</span>';
        }

        return implode('', $parts);
    }

    /**
     * Extract per-language values from a multilang message string.
     *
     * @param string $message
     * @return array
     */
    public function extract_multilang_messages(string $message): array {
        $result = [];
        $matches = [];

        preg_match_all(
            '/<span(?=[^>]*\blang="([a-zA-Z0-9_-]+)")(?=[^>]*\bclass="multilang")[^>]*>(.*?)<\/span>/is',
            $message,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            if (empty($match[1])) {
                continue;
            }

            $result[strtolower((string) $match[1])] = trim((string) $match[2]);
        }

        return $result;
    }

    /**
     * Decide whether a newly submitted configuration requires a version bump.
     *
     * @param object $currentconfiguration The stored configuration.
     * @param object $newconfiguration The submitted configuration.
     * @return bool
     */
    public function requires_version_bump(object $currentconfiguration, object $newconfiguration): bool {
        return $this->signature($currentconfiguration) !== $this->signature($newconfiguration);
    }

    /**
     * Determine the next message version for a configuration change.
     *
     * @param object $currentconfiguration The stored configuration.
     * @param object $newconfiguration The submitted configuration.
     * @return int
     */
    public function next_message_version(object $currentconfiguration, object $newconfiguration): int {
        $currentversion = isset($currentconfiguration->messageversion) ? (int) $currentconfiguration->messageversion : 1;

        if (!$this->requires_version_bump($currentconfiguration, $newconfiguration)) {
            return $currentversion;
        }

        return $currentversion + 1;
    }

    /**
     * Build the comparison signature for versioning decisions.
     *
     * @param object $configuration The configuration to compare.
     * @return string
     */
    private function signature(object $configuration): string {
        return json_encode([
            'enabled' => !empty($configuration->enabled) ? 1 : 0,
            'message' => isset($configuration->message) ? trim((string) $configuration->message) : '',
            'messagetype' => isset($configuration->messagetype) ? (string) $configuration->messagetype : 'info',
            'targetcapability' => isset($configuration->targetcapability)
                ? trim((string) $configuration->targetcapability)
                : 'moodle/site:config',
        ]);
    }
}
