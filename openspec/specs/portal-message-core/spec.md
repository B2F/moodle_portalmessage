## Purpose
Define backend configuration and eligibility rules for the portal message lifecycle.

## Requirements

### Requirement: Backend message configuration
The system MUST provide a local plugin configuration for the portal message text, message type, enabled state, target capability, and message version.

#### Scenario: Admin saves portal message settings
- **WHEN** an administrator updates the backend portal message configuration
- **THEN** the system stores the new values for text, type, enabled state, target capability, and version

### Requirement: Capability-controlled visibility
The system MUST only expose the portal message to users who have the capability selected in the backend configuration.

#### Scenario: User lacks selected capability
- **WHEN** a user does not have the configured capability
- **THEN** the system MUST treat the portal message as hidden for that user

### Requirement: Version-based invalidation
The system MUST increase the message version when the configured portal message content changes so prior dismissals no longer apply.

#### Scenario: Portal message content changes
- **WHEN** an administrator changes the configured portal message content
- **THEN** the system MUST assign a newer message version than the previous one
