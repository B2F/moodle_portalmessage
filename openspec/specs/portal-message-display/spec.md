## Purpose
Define how portal messages are rendered and presented to eligible users in the frontend.

## Requirements

### Requirement: Frontend block rendering
The system MUST render the portal message through a block plugin using a renderer and Mustache template.

#### Scenario: Block renders portal message
- **WHEN** a user can view the portal message
- **THEN** the block MUST render the configured message through the template pipeline

### Requirement: Message type presentation
The system MUST present the portal message using a message type that supports distinct visual and semantic output.

#### Scenario: Warning type is configured
- **WHEN** the backend message type is set to warning
- **THEN** the rendered message MUST use the warning presentation style

### Requirement: Translated strings
The system MUST provide translated strings for the portal message feature in English, Spanish, and French.

#### Scenario: Language pack lookup
- **WHEN** the site language is set to Spanish or French
- **THEN** the portal message strings MUST resolve from the corresponding translation files when available
