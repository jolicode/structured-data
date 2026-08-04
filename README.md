## JSON-LD and schema.org PHP library

This repository provides several tools to work with [JSON-LD](https://json-ld.org/) and [schema.org](https://schema.org/) in PHP.
It includes :
- an implementation of the W3C JSON-LD algorithms described in the [JSON-LD 1.1 Processing Algorithms and API Recommendation](https://www.w3.org/TR/json-ld-api) published on July 16th, 2020.
- a Schema.org validator.
- a Google validator, able to tell if your JSON-LD is eligible for [Google Rich Results](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data).

## Dependencies

This library requires:

- PHP >= 8.4, with the `dom`, `json` and `libxml` extensions
- (optional) the PHP task runner [Castor](https://github.com/jolicode/castor/), used for the tooling and the CLI interface. The development tooling additionally needs the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php) to download the W3C test suites.

## Booting

Install the PHP dependencies with Castor:

```bash
castor install
```

That's it! :)

## Validating a JSON-LD document

To validate a JSON-LD document, you must use the `Jolicode\JsonLd\Validator` class.

### Accepted inputs

You can validate:
- a direct (json) string input
- an absolute URL
- a relative file

The validator accepts the following data formats:
- json-ld
- microdata
- RDFa (schema.org style RDFa only)

### Using the validator

#### Basic usage

The validator exposes a single validation method: `audit()`.
It returns a `Jolicode\JsonLd\Audit\Audit` object holding the validation result.

To quickly check the result, use either of `isValid()` or `isFullyValid()`:
- `isValid` returns true if no errors are detected
- `isFullyValid` returns true if no errors, no warnings, and no malformed data structures (i.e. unusable) were detected

**Keep it mind that a schema.org type is considered valid even with warnings!**

To access the error messages themselves, use the `getDiagnostic()` method, which will return an array of error messages.

A pretty classic usage example would be doing something like this:

```php
use Jolicode\JsonLd\Validator;

$validator = new Validator();

$audit = $validator->audit('https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners');

if (!$audit->isValid()) {
  echo 'The provided document contains non-valid schema.org data!';

  // Returns an array of string error messages
  $diagnostic = $audit->getDiagnostic();

  foreach ($diagnostic as $message) {
    // Will look like this
    // [Google warning] DataFeed.dataFeedElement.workExample: Missing recommended property: "sameAs" for the type "Book"
    // [Google error] DataFeed.dataFeedElement.workExample.potentialAction.expectsAcceptanceOf: Missing required property: "price" for the type "Offer" when "category" is "purchase" or "rental".
    echo $message;
  }
} else {
  echo 'The JSON-LD document is valid!';
}
```

If you are only interested by the results of one validator, you can call `setValidator` first to set the desired validator:
```php
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator

$validator = new Validator();
$validator->setValidator(GoogleValidator::VALIDATOR_NAME);

$validator->audit('...');
```

#### Advanced Usage

The `getDiagnostic()` method accepts an optional parameter: a `Jolicode\JsonLd\Audit\AuditOptions` object, allowing you to filter or group the result, or to have a different return format. See the PHPDoc on `Jolicode\JsonLd\Audit\AuditOptions` for more details.

Finally, if you want to access the full parsed PHP tree, use `getTypes()` and inspect the underlying `MappedType` objects directly. These are low-level objects, but they are the most detailed informations you can get, and they respect the inheritance of the document.
To have an idea of what you can do with these objects, check the output of the `validate()` castor command, or our demo website.

### Reading the results

### Command Line Interface

A command is available to quickly validate a JSON-LD document from the CLI or the CI: `check()`.
Use the `validate()` command to get a nicely parsed and colored full audit (it can be pretty verbose!).
Both will return an explicit process exit code for scripting/CI usage.

```bash
castor check <file-or-url>
castor validate <file-or-url>
```

You can validate using a specific validator:

```bash
castor validate <file-or-url> google
```

```bash
castor validate <file-or-url> schema-org
```

Sample result of the validate command:
<img width="822" height="749" alt="Screenshot from 2026-05-05 14-38-31" src="https://github.com/user-attachments/assets/97912eb8-1e11-4ba9-8cc1-ac0b6248d816" />


## Using the JSON-LD algorithms

The currently available algorithms are:

- [x] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [x] [Framing](https://www.w3.org/TR/json-ld11-framing/#framing-algorithm)

Each algorithm is validated against the official W3C test suites ([json-ld-api](https://github.com/w3c/json-ld-api) and [json-ld-framing](https://github.com/w3c/json-ld-framing)).

To use them, initialize a new instance of the `Jolicode\JsonLd\Algorithms\Expand\Expander`, `Jolicode\JsonLd\Algorithms\Flatten\Flattener`, `Jolicode\JsonLd\Algorithms\Compact\Compactor` or `Jolicode\JsonLd\Algorithms\Frame\Framer` classes, and pass them the JSON-LD document you want to convert.

So, to expand a JSON-LD document you would need to do the following:

```php
use Jolicode\JsonLd\Algorithms\Expand\Expander;

$jsonString = '{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Doe"
}';

$expander = new Expander();
$result = $expander->expand($jsonString);
```

The result will be a json string containing the expanded JSON-LD document:

```php
[
  {
    "@type": [
      "http://schema.org/Person"
    ],
    "http://schema.org/name": [
      {
        "@value": "John Doe"
      }
    ]
  }
]
```

If you want a PHP object instead of a JSON string, set the `encodeResult` parameter to false when calling `expand()`.
You can also pass a `ProcessorOptions` object holding the [JSON-LD options](https://www.w3.org/TR/json-ld-api/#the-jsonldoptions-type) if you want to modify the default behavior of the algorithms:

```php
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;

$jsonString = '{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Doe"
}';

$options = new ProcessorOptions(
  ordered: true,
  frameExpansion: true,
);

$expander = new Expander();
$result = $expander->expand($jsonString, options: $options, encodeResult: false);
```

### Command Line Interface

Commands are also available to use the algorithms from the CLI :

```bash
castor json-ld:expand <file>
castor json-ld:flatten <file>
castor json-ld:compact <file> <context-file>
castor json-ld:frame <file> <frame-file>
```

They will print the output in the console.

## Testing and QA commands

The following commands are available to run the QA checks:

Command | Description | Aliases
---- | ----- | -----
`castor qa:cs` | Fix CS | `castor cs`
`castor qa:phpstan` | Runs PHPStan | `castor phpstan`
`castor qa:all` | Runs all QA tasks

The following commands are available to run the tests:

Command | Description | Aliases
---- | ----- | ----
`castor qa:phpunit:prepare` | Download the W3C tests suite
`castor qa:phpunit:run` | Runs PHPUnit | `castor test`, `castor tests`
`castor qa:phpunit:coverage` | Runs PHPUnit with code coverage (requires the pcov or xdebug extension) | `castor coverage`
`castor qa:infection` | Runs Infection mutation testing on the validator and mapper layers (requires the pcov or xdebug extension) | `castor infection`

The W3C test suite is pinned to a known-good upstream commit (see `W3C_TEST_SUITE_REF` in `tools/castor.php`).
To re-download it, or to test against the upstream main branch:

```bash
castor qa:phpunit:prepare --force
castor qa:phpunit:prepare --force --ref main
```

Additional commands are available to run the benchmarks:

Command | Description | Aliases
---- | ----- | ----
`castor qa:bench:all` | Run all the benchmarks | `castor bench`
`castor qa:bench:algorithms` | Run the JSON-LD manipulation algorithms benchmark
`castor qa:bench:validators` | Run the validators benchmark
`castor qa:bench:validators -d` | Run the detailed and slow validators benchmark

## Contributing

See the [CONTRIBUTING.md](CONTRIBUTING.md) file for more information.

### Upgrading Schema.org

Schema.org upgrades are driven by the official schema.org release definition file.
The complete upgrade process is documented in:
[resources/schema.org/UPGRADE_GUIDELINES.md](resources/schema.org/UPGRADE_GUIDELINES.md)

When upgrading, always review the [schema.org release notes](https://schema.org/docs/releases.html) and verify that the test schema-org-baseline.json changes reflect real Schema.org changes.

### Upgrading Google

The Google validator tracks the [Google structured-data documentation](https://developers.google.com/search/docs/advanced/structured-data/intro-structured-data), which evolves continuously.
The complete upgrade process is documented in:
[resources/google/UPGRADE_GUIDELINES.md](resources/google/UPGRADE_GUIDELINES.md)

## License

This library is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.
