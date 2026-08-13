# Upgrading the schema.org vocabulary

The schema.org validator is generated from the official schema.org release definition file.
Upgrading to a new release means regenerating those classes, then checking that every
difference reported by the tests is a genuine vocabulary change.

## 1. Select the target schema.org version

Run `castor schema-org:update-version`. It picks the latest release whose definition file is
actually published on GitHub, and updates the two constants that must always describe the
same release:

- `SchemaOrg::VERSION` in `generators/SchemaOrg/SchemaOrg.php`, which drives the generation;
- `SchemaOrgValidator::VOCABULARY_VERSION` in
  `src/Vocabularies/Validators/SchemaOrg/SchemaOrgValidator.php`, which the validator reports
  at runtime.

Add `--dry-run` to only report the release that would be selected, without writing anything.

To target another release, pick it on the
[schema.org releases page](https://schema.org/docs/releases.html) and update both constants
by hand.

## 2. Download the schema.org definition file

Run `castor schema-org:download`.

This fetches the JSON-LD definition of the configured release into `var/cache/schema-org/`.
Every release is stored under its own file name, so bumping the version never overwrites a
previously downloaded file. Use `--overwrite` to force a fresh download of the current one.

This step is optional: `castor schema-org:generate` downloads the file on its own when it is
missing.

## 3. Regenerate the schema.org classes

Run `castor schema-org:generate`.

This refreshes the generated validation classes in `src/Vocabularies/Generated/SchemaOrg/`.
The task also applies the coding standards to the generated files, so that regenerating from
the same definition file always yields the same tree and CI can check it with a plain
`git diff --exit-code`. The whole vocabulary is a few thousand classes, so this takes a while:
[go grab a coffee](https://www.youtube.com/watch?v=E4WlUXrJgy4).

The generation may break at this point, usually because the definition file contains new,
unexpected entries, or because schema.org introduced a new behavior. You will then need to
update the [generator](../../generators/SchemaOrg/Generator.php). The release page lists every
pull request merged for the release, which is the best place to look for the cause.

## 4. Refresh the schema.org examples used by the tests

Run `castor schema-org:download-examples`.

This clones the schema.org repository and updates the examples stored in
`resources/schema.org/examples/`.

## 5. Run the schema.org tests

Run the targeted test class:

```bash
tools/phpunit/vendor/bin/phpunit tests/Validation/SchemaOrg/SchemaOrgValidatorTest.php
```

or every test belonging to the schema.org group:

```bash
castor qa:phpunit:run -g schema-org
```

## 6. Fix the errors that showed up

Most of the time, nothing has to be changed: new types and properties are picked up
automatically.

If errors do appear, you will probably need to update the
[schema.org validator](../../src/Vocabularies/Validators/SchemaOrg/SchemaOrgValidator.php).
Read the reported errors carefully, then look for their cause in the schema.org release
description.

## 7. Update the test baselines

Review and update the expected errors in:

- `resources/schema.org/examples-baseline.json`
- `tests/Validation/fixtures/schema-org-baseline.json`

Only keep the baseline changes that reflect a real schema.org update. Anything else is a
regression to fix in the code, not in the baseline.

## 8. Run the full test suite

Run `castor qa:phpunit:run`, to make sure no regression was introduced in the validation paths
shared with the other vocabularies.

## 9. Keep the docs and the commands aligned

Update the tasks in `.castor/` if needed, and check that the command examples and the upgrade
notes in `README.md` are still accurate.

## 10. Submit a pull request!
