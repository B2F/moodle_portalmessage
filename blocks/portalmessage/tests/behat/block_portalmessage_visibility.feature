@block @block_portalmessage
Feature: Portal message visibility by capability
  In order to show portal announcements only to selected users
  As an administrator
  I need the portal message block to respect the configured capability

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | user1    | User      | 1        | user1@example.com    |
    And the following "roles" exist:
      | name                | shortname    | description                     | archetype |
      | Portal message user | portalviewer | Can view portal message content | user      |
    And the following "role capability" exists:
      | role                              | portalviewer |
      | local/portalmessage:viewmessage   | allow        |
    And the following "role assigns" exist:
      | user    | role         | contextlevel | reference |
      | viewer1 | portalviewer | System       |           |
    And the following config values are set as admin:
      | config           | value                            | plugin              |
      | enabled          | 1                                | local_portalmessage |
      | message          | Welcome to the portal message.   | local_portalmessage |
      | messagetype      | info                             | local_portalmessage |
      | targetcapability | local/portalmessage:viewmessage  | local_portalmessage |
    And the following "blocks" exist:
      | blockname     | contextlevel | reference | pagetypepattern | defaultregion |
      | portalmessage | System       | 1         | my-index        | side-post     |

  Scenario: User with configured capability sees the portal message on dashboard
    Given I log in as "viewer1"
    Then "Portal message" "block" should exist
    And I should see "Welcome to the portal message." in the "Portal message" "block"

  Scenario: User without configured capability does not see the portal message content
    Given I log in as "user1"
    Then "Portal message" "block" should not exist
