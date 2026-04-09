## Purpose
Define multilingual authoring and language-resolution behavior for portal message content.

## Requirements

### Requirement: Admin-authored multilang message content
The system MUST allow administrators to define a portal message containing multilang span markup in one configurable message field.

#### Scenario: Administrator saves multilingual message variants
- **WHEN** an administrator saves portal message content containing adjacent multilang spans for multiple languages
- **THEN** the system MUST persist the content without removing language span structure

### Requirement: Language-specific message resolution
The system MUST render the configured portal message according to the current user language when multilang markup is present.

#### Scenario: User language has an explicit variant
- **WHEN** the user language matches a language tag in the configured multilang message block
- **THEN** the rendered message MUST show the matching language variant

#### Scenario: User language has no explicit variant
- **WHEN** the user language does not match any language tag in the configured multilang message block
- **THEN** the rendered message MUST follow Moodle multilang fallback behavior for that block
