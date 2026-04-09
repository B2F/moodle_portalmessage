## Purpose
Define how users dismiss portal messages and how dismissal state is persisted and governed.

## Requirements

### Requirement: Dismissible portal message
The system MUST allow a user to dismiss the portal message from the frontend.

#### Scenario: User dismisses message
- **WHEN** a user activates the dismiss action
- **THEN** the system MUST record that the user dismissed the current message version

### Requirement: User preference storage
The system MUST store dismissal state in a user preference.

#### Scenario: Dismissal is persisted
- **WHEN** a user dismisses the portal message
- **THEN** the system MUST persist the dismissed message version in a user preference

### Requirement: Re-show after message change
The system MUST show the portal message again when the backend message version changes.

#### Scenario: Message version changes
- **WHEN** the current backend message version differs from the user preference value
- **THEN** the system MUST show the portal message again if the user still has the required capability

### Requirement: Privacy support for dismissal preference
The system MUST declare privacy support for the dismissal preference data stored for users.

#### Scenario: Privacy metadata is queried
- **WHEN** Moodle requests privacy information for the plugin
- **THEN** the system MUST expose the dismissal preference as user data subject to export and deletion handling
