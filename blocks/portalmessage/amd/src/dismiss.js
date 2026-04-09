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
 * Handles dismissing the portal message banner.
 *
 * @module     block_portalmessage/dismiss
 * @copyright  2026
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['core/ajax', 'core/notification'], function(Ajax, Notification) {
    const SELECTORS = {
        DISMISS: '[data-action="dismiss"]',
    };

    const dismissMessageVersion = (messageVersion) => {
        const request = {
            methodname: 'block_portalmessage_dismiss_message',
            args: {
                messageversion: messageVersion,
            },
        };

        return Ajax.call([request])[0];
    };

    const registerDismissHandler = (root) => {
        const dismissButton = root.querySelector(SELECTORS.DISMISS);
        if (!dismissButton) {
            return;
        }

        dismissButton.addEventListener('click', (event) => {
            event.preventDefault();

            const messageVersion = parseInt(root.dataset.messageVersion, 10);
            if (Number.isNaN(messageVersion)) {
                return;
            }

            dismissMessageVersion(messageVersion)
                .then(() => {
                    root.remove();
                    return null;
                })
                .catch(Notification.exception);
        });
    };

    return {
        init: (containerId) => {
            const root = document.getElementById(containerId);
            if (!root) {
                return;
            }

            registerDismissHandler(root);
        },
    };
});
