## Google Validator Upgrade Guidelines

Use these guidelines when upgrading Google rich-results support.

1. Refresh Google documentation corpus
Run `castor google:generation:crawle`, then `castor google:generation:verify-docs`.
Review fetch failures, missing manifest entries, missing implementations, and stale entries.
Review diff in downloaded HTML classes.

2. Update structured-data JSON definitions
Edit files in `resources/google/structured-data/`accordingly to the results of the two previous commands.
Keep constraints focused on required/recommended fields, clear conditional requirements, and `specialRules` keys for non-static logic.

3. Regenerate Google classes
Run `castor generate google` and verify generated constants/properties in `src/Vocabularies/Generated/Google/`.
Run `castor cs` to apply CS rules to the generated files.

4. Validate special-rule wiring
Ensure each special rule class exists in `src/Vocabularies/Validators/Google/SpecialRules/` and each rule key is referenced in the right `resources/google/structured-data/*.json` file.
Ensure severities/messages are intentional (`ERROR` vs `WARNING`).

5. Update tests
Add focused fixtures in `tests/Validation/fixtures/Google/` and update expectations in `tests/Validation/fixtures/google-baseline.json`.
Keep fixtures mostly valid and isolate one behavior per fixture when possible.

6. Run tests
Run Google targeted tests with `php tools/phpunit/vendor/bin/phpunit tests/Validation/Google/GoogleValidatorTest.php` (to run the GoogleValidatorTest) or `castor test -g google` (to run all tests belonging to the google group).

7. Check for regressions outside Google
If behavior touches shared extractor/mapper/validator paths, run schema.org-focused validation tests and confirm no baseline/message regressions.
Then run `castor test`.

8. Keep docs aligned
Ensure command examples in `README.md` and `resources/google/structured-data/README.md` match actual task names and behavior.

9. Keep it lightweight
Prefer deterministic rules over fuzzy matching, avoid costly heuristics, and centralize shared behavior only when it clearly benefits both validators.

CI note for `castor google:generation:verify-docs`:
- Prefer report-only mode by default (do not fail the pipeline when Google changes docs upstream).
- Run strict/failing mode only for scheduled maintenance checks or explicit upgrade branches.
- In GitHub Actions CI, strict mode is available via manual trigger (`workflow_dispatch`) with `google_docs_strict=true`.

/!\ `verify-docs` should not be blocking by default /!\
Google can add, remove, or rename documentation pages at any time, which can fail the CI without any code change in this repository.

Recommended policy:
- `push`/`pull_request` pipelines: run `verify-docs` in report-only mode.
- Dedicated upgrade work: run strict mode and treat failures as upgrade tasks.
