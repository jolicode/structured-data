## JSON-LD and schema.org PHP library

This repository provides several tools to work with [JSON-LD](https://json-ld.org/) and [schema.org in PHP](https://schema.org/).
It includes :
- an implementation of the W3C JSON-LD algorithms described in the [JSON-LD 1.1 Processing Algorithms and API Recommendation](https://www.w3.org/TR/json-ld-api) published on July 16th, 2020.
- a Schema.org validator, able to validate the provided document is a valid json-ld document and that it complies with the schema.org specifications.
- a Google validator, able to tell if the provided json-ld structure implements all the required properties to be eligible for the Google Rich Results. It will also point out missing recommended Google properties and validate against Google-specific special rules.

## Dependencies

This library requires:

- PHP >= 8.4
- the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php);
- the PHP task runner [Castor](https://github.com/jolicode/castor/), used for the tooling and the CLI interface.

## Getting started

Install the PHP dependencies with Castor:

```bash
castor install
```

That's it! :)

## Using the JSON-LD algorithms

The currently available algorithms are:

- [ ] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [ ] [Framing](https://www.w3.org/TR/json-ld11-framing/#framing-algorithm)

To use them, initialize a new instance of the `Jolicode\JsonLd\Algorithms\Expand\Expander` or of the `Jolicode\JsonLd\Algorithms\Flatten\Flattener` classes, and pass them the JSON-LD document you want to convert.

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

If you want a PHP object instead of a JSON string, you can set the `encodeResult` parameter to false when initializing the `Expander` or the `Flattener`:
You can also pass an array of [JSON-LD options](https://www.w3.org/TR/json-ld-api/#the-jsonldoptions-type) if you want to modify the default behavior of the algorithms :

```php
use Jolicode\JsonLd\Algorithms\Expand\Expander;

$jsonString = '{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Doe"
}';

$options = [
  'ordered' => true,
  'frameExpansion' => true,
];

$expander = new Expander(encodeResult: false, options: $options);
$result = $expander->expand($jsonString);
```

### Command Line Interface

Commands are also available to use the algorithms from the CLI :

```bash
castor json-ld:expand <file>
castor json-ld:flatten <file>
```

They will print the output to STDOUT.

## Validating a JSON-LD document

To validate a JSON-LD document, you must use the `Jolicode\JsonLd\Validator` class.

If you just want to quickly check if a document is valid, you can use the `isValid()` method.
The `isValid()` method returns a boolean indicating whether the provided document is valid or not.
If at least one invalid schema.org data structure is found in the document, the method will return false.

```php
use Jolicode\JsonLd\Validator;

$validator = new Validator();

if (
    !$validator->isValid('https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners')
) {
    echo 'The provided document contains non-valid schema.org data.';
}
```

For more advanced usages, you can use the `getTypes()` method to get more information about the parsed structured data and their associated errors.
This method will return an array of `Jolicode\Vocabularies\Mapper\MappedType` objects, each of them containing a lot of information, including the found errors.

### Command Line Interface

A command is also available to validate a JSON-LD document from the CLI:

```bash
castor schema-org:validate <file-or-url>
```

You can also validate against a specific validator (currently `google` or `schemaorg`):

```bash
castor schema-org:validate <file-or-url> google
```

```bash
castor schema-org:validate <file-or-url> schemaorg
```

You can pass the `--details` option to get more details (it can be pretty verbose!).

## Known limits vs Google Rich Results Test

This project aims to provide deterministic, explainable validation based on [public Google documentation](https://developers.google.com/search/docs/advanced/structured-data/intro-structured-data).
[Google's Rich Results Test](https://search.google.com/test/rich-results) is a useful signal, but it may produce different outputs (detected item types, warnings, or eligibility) for the same input.

In practice, this validator should be treated as a strong authoring and CI guardrail, while Google's tooling should be treated as an additional external check.
Passing one tool does not always imply identical output in the other.

## Upgrading the Google or Schema.org versions

### Upgrading Schema.org

Schema.org upgrades are driven by the official schema.org release definition file.
The complete upgrade process is documented in:
`resources/schema.org/UPGRADE_GUIDELINES.md`

When upgrading, always review the [schema.org release notes](https://schema.org/docs/releases.html) and verify that the test schema-org-baseline.json changes reflect real upstream changes.

### Upgrading Google

The Google validator tracks the [Google structured-data documentation](https://developers.google.com/search/docs/advanced/structured-data/intro-structured-data), which evolves continuously.
The complete upgrade process is documented in:
`resources/google/UPGRADE_GUIDELINES.md`

### Testing and QA commands

The following commands are available to run the QA checks:

Command | Description
---- | -----
`castor qa:cs` | Fix CS
`castor qa:phpstan` | Runs PHPStan
`castor qa:all` | Runs all QA tasks

The following commands are available to run the tests:

Command | Description | Aliases
---- | ----- | ----
`castor qa:phpunit:prepare` | Download the W3C tests suite
`castor qa:phpunit:run` | Runs PHPUnit | `castor test`, `castor tests`

The test suite changes from time to time, so it is recommended to update the test suite before running the tests:

```bash
castor qa:phpunit:prepare --force
```

Additional commands are available to run the benchmarks:

Command | Description
---- | -----
`castor qa:bench:all` | Run all the benchmarks
`castor qa:bench:algorithms` | Run the JSON-LD manipulation algorithms benchmark
`castor qa:bench:validators` | Run the schema.org validators benchmark

## Contributing

See the [CONTRIBUTING.md](CONTRIBUTING.md) file for more information.

## License

This library is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.
