## Purpose
Define how portal message content is formatted and filtered before display.

## Requirements

### Requirement: Filter-aware portal message rendering
The system MUST render admin-authored portal message content through Moodle text formatting and filter processing before output.

#### Scenario: Message contains multilang span markup
- **WHEN** the configured portal message includes multilang span markup
- **THEN** the rendering pipeline MUST process the message through Moodle formatting/filter APIs before displaying it in the block

### Requirement: Backward compatibility for plain text messages
The system MUST continue to display existing plain text portal messages after filter-aware rendering is introduced.

#### Scenario: Existing plain text configuration is present
- **WHEN** the configured portal message contains no multilang markup
- **THEN** the block MUST still display the message content correctly without requiring administrator migration steps
