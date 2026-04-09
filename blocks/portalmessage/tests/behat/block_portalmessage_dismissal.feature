@block @block_portalmessage @javascript
Feature: Portal message dismissal and re-display flow
  In order to keep portal announcements manageable
  As an administrator
  I need to dismiss a message and see it again after version changes

  Background:
    Given the following config values are set as admin:
      | config           | value                         | plugin              |
      | enabled          | 1                             | local_portalmessage |
      | message          | Portal update for all users.  | local_portalmessage |
      | messagetype      | info                          | local_portalmessage |
      | targetcapability | moodle/site:config            | local_portalmessage |
      | messageversion   | 1                             | local_portalmessage |
    And the following "blocks" exist:
      | blockname     | contextlevel | reference | pagetypepattern | defaultregion |
      | portalmessage | System       | 1         | my-index        | side-post     |

  Scenario: Admin dismisses current message and sees it again after version update
    Given I log in as "admin"
    Then "Portal message" "block" should exist
    And I should see "Portal update for all users." in the "Portal message" "block"
    When I click on "Close" "button" in the "Portal message" "block"
    Then "Portal message" "block" should not exist
    And the following config values are set as admin:
      | config         | value | plugin              |
      | messageversion | 2     | local_portalmessage |
    And I am on homepage
    Then "Portal message" "block" should exist
    And I should see "Portal update for all users." in the "Portal message" "block"
