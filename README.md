## Welcome to the JoliCode JSON-LD implementation !

This repository aims at validating users JSON-LD to ensure that they comply with both the schema.org recommendations and the Google constraints.
More informations about the JSON-LD format are available on the [official website](https://json-ld.org/) and on [google](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data).

For now, the only available feature is the conversion of a JSON-LD file to a given format.
In the near future, we expect to implement the validation of a JSON-LD file.

## Dependencies

The minimal PHP version required is 8.2.
This library requires the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php).

## Installation

The library needs to download some files and to generates classes to work.
First, this is a PHP project, so you will need to install the dependancies with composer :
```bash
composer install
```

Then, you will need to generate the PHP classes :
```make
make generate
```

## How to use it?

We provide several commands allowing you to run the project.
To convert a JSON-LD file to a given format, you can use the related commands. For now, available commands are the following :

```bash
bin/json-ld expand [filename]
bin/json-ld flatten [filename]
```

The filename argument can be a relative IRI, an absolute IRI or a direct JSON-LD string.

## The JSON-LD algorithms

Informations about the algorithms are available in the [W3C documentation](https://www.w3.org/TR/json-ld11-api/).
This library provides an implementation of these recommendations, although we also took inspiration from [the Javascript Library](https://github.com/digitalbazaar/jsonld.js), which also follows the W3C recommendations.

The algorithms currently available are the following :
- [] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [] [Framing](https://www.w3.org/TR/json-ld11-framing/)

## Testing

This library uses the [W3C test suite](https://github.com/w3c/json-ld-api/tree/main/tests) to test its algorithms.

Since this is a pretty big test suite, we didn't version it. The library will automatically download it when you run the tests with
```bash
make test
```

We also provide a way of removing or resetting the test files if you have issues with them.
To remove them, run
```bash
make delete_test
```

To reset them, run
```bash
make reset_test
```

