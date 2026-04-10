# local_portalmessage

Local plugin backing the **Portal message** feature.

- Admin settings live in `local/portalmessage/settings.php`
- Language resolution and message composition live in `local/portalmessage/lib.php`
- Dismissal is stored as a user preference and exposed via the Privacy API

For overall feature documentation (including the paired block), see the repository `README.md` and `openspec/specs/portal-message-*/spec.md`.

## Quality checks

Run coding standard checks for the new portal message plugins:

```bash
php vendor/bin/phpcs --standard=phpcs.xml.dist public/local/portalmessage public/blocks/portalmessage
```

Run static analysis for portal message classes:

```bash
php vendor/bin/phpstan analyse public/local/portalmessage/classes public/blocks/portalmessage/classes --level=5
```
