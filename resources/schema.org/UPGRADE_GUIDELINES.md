## Schema.org Validator Upgrade Guidelines

Use these guidelines when upgrading schema.org support.

1. Select target schema.org version
Set the target release in `src/Vocabularies/SchemaOrg.php` (`SchemaOrg::VERSION`).
Use an official schema.org release.

2. Download the authoritative schema.org definition file
Run `castor schema-org:generation:download-definition`.
This fetches the canonical schema.org JSON-LD definition for the configured version.

3. Regenerate schema.org classes
Run `castor schema-org:generation`.
Verify generated classes in `src/Vocabularies/Generated/SchemaOrg/`.

4. Refresh schema.org examples used by tests
Run `castor schema-org:generation:update-examples`.
This updates examples in `resources/schema.org/examples/`.

5. Update schema.org test baselines
Review and update expected errors in:
- `resources/schema.org/examples-baseline.json`
- `tests/Validation/fixtures/schema-org-baseline.json`
Only keep baseline changes that reflect real schema.org updates.

6. Run focused validation tests
Run `php tools/phpunit/vendor/bin/phpunit tests/Validation/SchemaOrg/SchemaOrgValidatorTest.php`.

7. Run full suite
Run `castor test` to detect cross-validator regressions.

8. Validate behavioral changes carefully
If required/recommended properties changed, confirm failures are expected.
If new failures appear in non-schema.org tests, investigate shared mapper/validator code paths.

9. Keep docs aligned
Ensure command examples and upgrade notes in `README.md` remain accurate.

