# local_portalmessage

## Quality checks

Run coding standard checks for the new portal message plugins:

```bash
php vendor/bin/phpcs --standard=phpcs.xml.dist public/local/portalmessage public/blocks/portalmessage
```

Run static analysis for portal message classes:

```bash
php vendor/bin/phpstan analyse public/local/portalmessage/classes public/blocks/portalmessage/classes --level=5
```
