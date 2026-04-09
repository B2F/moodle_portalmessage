@block @block_portalmessage
Feature: Portal message multilang rendering
  In order to display localized portal messages
  As users with different preferred languages
  I need the portal message to resolve multilang content per language with fallback behavior

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | vieweren | Viewer    | EN       | vieweren@example.com |
    And the following "roles" exist:
      | name                | shortname    | description                     | archetype |
      | Portal message user | portalviewer | Can view portal message content | user      |
    And the following "role capability" exists:
      | role                            | portalviewer |
      | local/portalmessage:viewmessage | allow        |
    And the following "role assigns" exist:
      | user     | role         | contextlevel | reference |
      | vieweren | portalviewer | System       |           |
    And the "multilang" filter is "on"
    And the "multilang" filter applies to "content and headings"
    And the following config values are set as admin:
      | config           | value                                                                                                                                                    | plugin              |
      | enabled          | 1                                                                                                                                                        | local_portalmessage |
      | message          | <span lang="en" class="multilang">English portal message</span><span lang="fr" class="multilang">Message portail francais</span>                 | local_portalmessage |
      | messagetype      | info                                                                                                                                                     | local_portalmessage |
      | targetcapability | local/portalmessage:viewmessage                                                                                                                         | local_portalmessage |
      | messageversion   | 1                                                                                                                                                        | local_portalmessage |
    And the following "blocks" exist:
      | blockname     | contextlevel | reference | pagetypepattern | defaultregion |
      | portalmessage | System       | 1         | my-index        | side-post     |

  Scenario: User with matching language sees the matching variant
    Given I log in as "vieweren"
    Then I should see "English portal message"
    And I should not see "Message portail francais"

  Scenario: User without explicit language variant sees fallback
    Given the following config values are set as admin:
      | config  | value                                                                                                                             | plugin              |
      | message | <span lang="fr" class="multilang">Message de secours</span><span lang="es" class="multilang">Mensaje de respaldo</span> | local_portalmessage |
    And I log in as "vieweren"
    Then I should see "Message de secours"
    And I should not see "Mensaje de respaldo"
