# Upgrading the Google vocabulary

The Google validator tracks the Google structured-data documentation, which evolves
continuously and without any release or version number. Upgrading means crawling the
documentation again, deciding what to do with the changes it reports, and reflecting them in
the JSON definitions the validation classes are generated from.

## 1. Refresh the Google documentation corpus

Run `castor google:download`, then `castor google:check`.

The first task crawls the Google documentation, rewrites the curated manifest in
[google-types.json](./google-types.json), and downloads the HTML of the tracked types into
`resources/google/downloads/`. The second one compares the live documentation with the
manifest and the current JSON definitions, and reports everything that drifted.

## 2. Update the manifest

The [manifest](./google-types.json) keeps track of what we support, and the crawl only
refreshes it with what it found. Reviewing its git diff and curating it by hand is up to you:
a new type may have appeared, a type may have been removed, deprecated, or renamed.

Each entry holds a `slug` and a `url`, plus two optional keys:

- `status`, which defaults to `active`. Use `skip` for a page that is not a real structured
  data type, and `retired` for a type Google no longer documents. Both take the page out of
  the generation. `extra` marks a page that is not listed in the search gallery but is still
  worth tracking.
- `note`, a short sentence explaining the decision, so the next person does not have to
  investigate it again.

The extracted HTML stored in `resources/google/downloads/` is versioned too, so its git diff
is usually the quickest way to understand what changed on a page.

> [!WARNING]
> Only a portion of each page is extracted, not the whole document. The reason
> for a change is sometimes outside that portion, and you will then need to open the page
> itself to find out what happened.

## 3. Update the structured-data JSON definitions

Edit the files in `resources/google/structured-data/` according to the results of the two
previous commands.

Most changes are visible in the HTML diff and are straightforward to apply: they are usually
new or updated required and recommended properties.

Google occasionally introduces very specific rules that cannot be expressed declaratively.
These live under the `specialRules` key: register the rule here, and implement it in step 5.

You may also need to add a completely new type. Follow the existing structure strictly, and
read [the dedicated readme](./structured-data/README.md) to understand how these JSON files
are organized.

## 4. Regenerate the Google classes

Run `castor google:generate`.

This refreshes the generated validation classes in `src/Vocabularies/Generated/Google/`. The
task also applies the coding standards to the generated files, so that regenerating from the
same JSON definitions always yields the same tree and CI can check it with a plain
`git diff --exit-code`.

## 5. Check how the special rules are wired

Make sure every special rule class exists in `src/Vocabularies/Validators/Google/SpecialRules/`
and that every rule key is referenced in the right `resources/google/structured-data/*.json`
file.

Check that the severities and messages are intentional: `ERROR` marks an invalid document,
`WARNING` only reports something suspicious.

A special rule you added yourself needs its class, its logic, and a test.

## 6. Update the tests

If needed, add fixtures in `tests/Validation/fixtures/google/` and update the expectations in
`tests/Validation/fixtures/google-baseline.json`.

Isolate one problematic behavior per fixture whenever possible, and give it a clear name.

## 7. Run the Google tests

Run the targeted test class:

```bash
tools/phpunit/vendor/bin/phpunit tests/Validation/Google/GoogleValidatorTest.php
```

or every test belonging to the google group:

```bash
castor qa:phpunit:run -g google
```

## 8. Check for regressions outside Google

If the changes touch the extractor, the mapper, or the shared validation paths, run the
schema.org validation tests too and confirm that no baseline or message regressed.

Then run the full suite with `castor qa:phpunit:run`.

## 9. Keep the docs aligned

Check that the command examples in `README.md` and in
`resources/google/structured-data/README.md` still match the actual task names and behavior,
and update the tasks in `.castor/` if needed.

## 10. A note about `castor google:check` on CI

> [!WARNING]
> `google:check` must not block the pipeline by default.

Google can add, remove, or rename documentation pages at any time, which would fail CI without
a single change in this repository. The policy is therefore:

- on `push` and `pull_request`, run `google:check` in report-only mode;
- on a dedicated upgrade branch, run it in strict mode and treat every failure as an upgrade
  task.

In GitHub Actions, strict mode is available through a manual trigger (`workflow_dispatch`)
with `google_docs_strict=true`.

## 11. Submit a pull request!
