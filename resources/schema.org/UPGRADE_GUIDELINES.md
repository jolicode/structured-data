## Schema.org Validator Upgrade Guidelines

### 1. Select the target schema.org version

Run `castor schema-org:update-version`: it picks the latest release whose definition file is
actually published on GitHub, and updates both `generators/SchemaOrg/SchemaOrg.php`
(`SchemaOrg::VERSION`) and the runtime constant `SchemaOrgValidator::VOCABULARY_VERSION` in
`src/Vocabularies/Validators/SchemaOrg/SchemaOrgValidator.php`, which must always describe the
same release. Use `--dry-run` to only report the release that would be selected.

To target another release, head to
[https://schema.org/docs/releases.html](https://schema.org/docs/releases.html), select it, and
update both constants by hand.

### 2. Download the schema.org definition file

Run `castor schema-org:download`.

This fetches the schema.org JSON-LD definition for the configured release.

You will see it in the `var/cache/schema-org` directory.

### 3. Regenerate schema.org classes

Run `castor schema-org:generate`.

This will refresh the generated classes (used for validation) in `src/Vocabularies/Generated/SchemaOrg/`.

The generation may be broken at this point. If this is the case, you will need to update the [Schema.org Generator](../../generators/SchemaOrg/Generator.php).

This will probably be because there are new, unexpected entries in the definition file. Or because schema.org introduced a new behavior.

The release page lists all the PR merged for this release, you will need to inspect them.

The task applies the CS rules to the generated files itself (and [go grab a coffee](https://www.youtube.com/watch?v=E4WlUXrJgy4), this takes somes time).

### 4. Refresh schema.org examples used by tests

Run `castor schema-org:download-examples`.

This updates examples in `resources/schema.org/examples/`.

### 5. Run the Schema.org test suite

Run Schema.org targeted tests with `tools/phpunit/vendor/bin/phpunit tests/Validation/SchemaOrg/SchemaOrgValidatorTest.php` (to run the SchemaOrgValidatorTest) or `castor qa:phpunit:run -g schema-org` (to run all tests belonging to the schema.org group).

### 6. Fix the introduced errors

Most of the time, you won't need to update the codebase. The new properties/types will update themselves.

If errors are nevertheless introduced, you will probably need to update the [Schema.org Validator](../../src/Vocabularies/Validators/SchemaOrg/SchemaOrgValidator.php).

Carefully read errors spotted by the tests and find why are they here in the Schema.org release description.

### 7. Manually update schema.org test baselines

Review and update expected errors in:
- `resources/schema.org/examples-baseline.json`
- `tests/Validation/fixtures/schema-org-baseline.json`

Only keep baseline changes that reflect real schema.org updates.

### 8. Run the full tests suite

To ensure no regression in the shared validation path was introduced, run
`castor qa:phpunit:run`

### 9. Keep docs and commands aligned

If needed, update the tasks in `.castor/`.
Ensure command examples and upgrade notes in `README.md` remain accurate.

### 10. Submit a PR!
