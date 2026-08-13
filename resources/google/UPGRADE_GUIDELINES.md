## Google Validator Upgrade Guidelines

### 1. Refresh Google documentation corpus
Run `castor google:generation:crawl-google`, then `castor google:generation:verify-docs`.

This will crawl the google docs and generate a full report of all the updates found in the google documentation.

### 2. Update the manifest
We use a [manifest](./google-types.json) to keep track of what we currently support.

It should be updated whenever relevant changes are spotted by the command: it could be a new, insupported type, the removal of a type, a deprecated type...

We also use some extracted HTML for each type to keep track of the changes. They may be found in the `resources/google/downloads` directory.

Update the manifest to register the changes discovered by the command.

Use the git diff in the corresponding HTML file to better describe what happened if needed.

/!\ We only extract a portion of the docs, not the full page. Sometimes, the reason for a change may not be present in the extracted HTML. If this is the case, you will need to read the page of the element and try to find the reason by yourself /!\

### 3. Update structured-data JSON definitions
Edit files in `resources/google/structured-data/` accordingly to the results of the two previous commands.

Usually, all changes should be visible in the HTML diff and should be easy to update. They should just be about new or updated required/recommended properties.

However, sometimes, some very specific rules are introduced. We can't really handle them programatically, so for these we use the `specialRules` key. You may need to add a special rule here and implement it later.

You may need to add a completely new type. Strictly follow the structure we use. There is [a dedicated readme](./structured-data/README.md) to help understanding our JSON files.

### 4. Regenerate Google classes
Run `castor generate google`

This will refresh the generated classes in `src/Vocabularies/Generated/Google/`.

Run `castor cs` to apply CS rules to the generated files.

### 5. Validate special rules wiring
Ensure each special rule class exists in `src/Vocabularies/Validators/Google/SpecialRules/` and each rule key is referenced in the right `resources/google/structured-data/*.json` file.

Ensure severities/messages are intentional (`ERROR` vs `WARNING`).

If you added a special rule yourself, you will need to create the class and implement the logic. Also, if you add a new special rule, please add a test for it.

### 6. Update the tests
If needed, add fixtures in `tests/Validation/fixtures/Google/` and update the expectations in `tests/Validation/fixtures/google-baseline.json`.

Try to isolate one problematic behavior per fixture when possible. Keep a clear name.

### 7. Run the tests
Run Google targeted tests with `tools/phpunit/vendor/bin/phpunit tests/Validation/Google/GoogleValidatorTest.php` (to run the GoogleValidatorTest) or `castor test -g google` (to run all tests belonging to the google group).

### 8. Check for regressions outside Google
If behavior touches shared extractor/mapper/validator paths, run schema.org-focused validation tests and confirm no baseline/message regressions.
Then run `castor test`.

### 9. Keep docs aligned
Ensure command examples in `README.md` and `resources/google/structured-data/README.md` match actual task names and behavior.

Update `castor.php` if needed.

### 10. CI note for `castor google:generation:verify-docs`:
/!\ `verify-docs` should not be blocking by default /!\\

Google can add, remove, or rename documentation pages at any time, which can fail the CI without any code change in this repository.

- Prefer report-only mode by default (do not fail the pipeline when Google changes docs upstream).
- Run strict/failing mode only for explicit Google upgrade branches.
- In GitHub Actions CI, strict mode is available via manual trigger (`workflow_dispatch`) with `google_docs_strict=true`.

Recommended policy:
- `push`/`pull_request` pipelines: run `verify-docs` in report-only mode.
- Dedicated upgrade work: run strict mode and treat failures as upgrade tasks.
