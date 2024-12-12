## JSON-LD and schema.org PHP library

This repository provides several tools to work with [JSON-LD](https://json-ld.org/)
and [schema.org in PHP](https://schema.org/). It includes a JSON-LD validator and
an implementation of the W3C JSON-LD algorithms described in the
[JSON-LD 1.1 Processing Algorithms and API Recommendation](https://www.w3.org/TR/json-ld-api),
published on July 16th, 2020.

## Dependencies

This library requires:

- PHP >= 8.2
- the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php);
- the PHP task runner [Castor](https://github.com/jolicode/castor/), used for the tooling and the CLI interface.

## Installation

Install PHP dependancies with Composer:

```bash
composer install
```

## Programatic API

### Expanding a JSON-LD document

```php
use Jolicode\JsonLd\Algorithms\Expand\Expander;

// let $jsonString be a JSON-LD document
$jsonString = '{
  "@context": {
    "d": "http://purl.org/dc/elements/1.1/",
    "e": "http://example.org/vocab#",
    "f": "http://xmlns.com/foaf/0.1/",
    "xsd": "http://www.w3.org/2001/XMLSchema#"
  },
  "@id": "http://example.org/test",
  "e:bool": true,
  "e:int": 123
}';

$expander = new Expander();

// get a json string containing the expanded JSON-LD document
$expanded = $expander->expand($jsonString);

// $expanded value:
//
// [{
//   "@id": "http://example.org/test",
//   "http://example.org/vocab#bool": [{"@value": true}],
//   "http://example.org/vocab#int": [{"@value": 123}]
// }]

// get a json object containing the expanded JSON-LD document
$expanded = $expander->expand($jsonString, encodeResult: false);
```

### Flattening a JSON-LD document

```php
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;

// let $jsonString be a JSON-LD document
$jsonString = '{
  "@context": {"foo": {"@id": "http://example.com/foo", "@container": "@list"}},
  "foo": [
    [{"@id": "http://example/a", "@type": "http://example/Bar"}],
    {"@id": "http://example/b", "@type": "http://example/Baz"}]
}';

$flattener = new Flattener();

// get a json string containing the flattened JSON-LD document
$flattened = $flattener->flatten($jsonString);

// $flattened value:
//
// [{
//   "@id": "_:b0",
//   "http://example.com/foo": [{"@list": [
//     {"@list": [{"@id": "http://example/a"}]},
//     {"@id": "http://example/b"}
//   ]}]
// },
// {
//   "@id": "http://example/a",
//   "@type": [
//     "http://example/Bar"
//   ]
// },
// {
//   "@id": "http://example/b",
//   "@type": [
//     "http://example/Baz"
//   ]
// }]
```

### Validating a JSON-LD document

The `isValid()` method returns a boolean indicating whether the provided document is valid or not.
If at least one schema.org data structure is found in the document that is not valid, the method
will return false.

```php
use Jolicode\JsonLd\Validator;

$validator = new Validator();

if (
    !$validator->isValid('https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners')
) {
    echo 'The provided document contains non-valid schema.org data.';
}
```

For more adavanced usages, you can use the `getTypes()` method to get more informations about the
parsed structured data and their associated errors.

## Command Line Interface

The project provides a Command Line Interface (CLI) to use the JSON-LD algorithms and the schema.org validator:

```bash
castor json-ld:expand <file>
castor json-ld:flatten <file>
castor schema-org:validate <file-or-url>
```

Apart from these usage commands, the project provides additional commands to
generate the schema.org PHP classes and to run the tests and QA checks

### Code generation commands

Command | Description
---- | -----
`castor generator:install` | Installs generator tooling
`castor generator:update` | Updates generator tooling
`castor generator:generate` | Generate classes for JSON-LD validation
`castor generator:schema-org:download-definition` | Download the schema.org types definition file.
`castor generator:schema-org:update-examples` | Updates the schema.org example files stored in the resources directory

The usual process to update the schema.org version used by this library is:

- bump the version of the schema.org definition in the `src/SchemaOrg/SchemaOrg.php` file
- run `castor generator:generate` to update the schema.org classes
- run `castor generator:schema-org:update-examples` to update the examples. This will add new examples in the `resources/schema.org/examples` directory
- run the tests to ensure everything is working as expected:
  ```bash
  castor qa:phpunit:run
  ```
- run the QA checks to ensure the code is compliant with the coding standards:
  ```bash
  castor qa:all
  ```
- propose a Pull Request with the changes - see the [CONTRIBUTING.md](CONTRIBUTING.md) file for more information.

### Testing and QA commands

The following commands are available to run the QA checks:

Command | Description
---- | -----
`castor qa:install` | Installs QA tooling
`castor qa:update` | Updates QA tooling
`castor qa:all` | Runs all QA tasks
`castor qa:cs` | Fix CS
`castor qa:phpstan` | Runs PHPStan

The following commands are available to run the tests:

Command | Description
---- | -----
`castor qa:phpunit:prepare` | Download the W3C tests suite
`castor qa:phpunit:run` | Runs PHPUnit

Additional commands are available to run the benchmarks:

Command | Description
---- | -----
`castor qa:bench:all` | Run all the benchmarks
`castor qa:bench:algorithms` | Run the JSON-LD manipulation algorithms benchmark
`castor qa:bench:validators` | Run the schema.org validators benchmark

## The JSON-LD algorithms

Informations about the algorithms are available in the
["JSON-LD 1.1 Processing Algorithms and API" Recommendation](https://www.w3.org/TR/json-ld11-api/).
This library provides an implementation of this Recommendation.

The currently available algorithms are:

- [ ] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [ ] [Framing](https://www.w3.org/TR/json-ld11-framing/)

## Testing

This library uses the [JSON-LD Test Suite](https://github.com/w3c/json-ld-api/tree/main/tests)
to test the algorithms implementation.

Tests can be executed with the following command:

```bash
castor qa:phpunit:run
```

If required, this will download the test suite from the W3C repository in
the `var/cache` directory. The test suite changes from time to time, so it is
recommended to update the test suite before running the tests:

```bash
castor qa:phpunit:prepare --force
```

## Contributing

See the [CONTRIBUTING.md](CONTRIBUTING.md) file for more information.

## License

This library is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.
