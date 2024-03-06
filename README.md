## Welcome to the JoliCode JSON-LD implementation !

This repository aims at validating users JSON-LD to ensure that they comply with both the schema.org recommendations and the Google constraints.
More informations about the JSON-LD format are available on the [official website](https://json-ld.org/) and on [google](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data).

To do so, it also uses the W3C JSON-LD algorithms to convert JSON-LD files from and to a given format. It is possible to use this library only to use these algorithms, without the validation part.

## Dependencies

The minimal PHP version required is 8.2.
This library requires the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php).

This library also uses a PHP task runner called [castor](https://github.com/jolicode/castor/). It is just a task runner so it is not mandatory, since you may run all the commands manually (we provide a bin/json-ld to run them).

## Installation

The library needs to download some files and to generates classes to work.
First, this is a PHP project, so you will need to install the dependancies with composer :
```bash
composer install
```

Then, you will need to generate the PHP classes :
```bash
castor generate
```

## The JSON-LD algorithms

Informations about the algorithms are available in the [W3C documentation](https://www.w3.org/TR/json-ld11-api/).
This library provides an implementation of these recommendations, although we also took inspiration from [the Javascript Library](https://github.com/digitalbazaar/jsonld.js), which also follows the W3C recommendations.

The algorithms currently available are the following :
- [] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [] [Framing](https://www.w3.org/TR/json-ld11-framing/)

## How to use it?

### In CLI

We provide several commands allowing you to run the project.
To list them all, run

```bash
castor
```

It will install castor for this project and list all the available commands with their descriptions.
If you don't want to use Castor, you can use the bin/json-ld file to run the commands.

### In your code

#### Algorithms
To use the JSON-LD converstion algorithms, use the corresponding PHP classes :
- Jolicode\JsonLd\Algorithms\Expand\Expander
- Jolicode\JsonLd\Algorithms\Flatten\Flattener

Instantiate them and call the `expand` or `flatten` method with the JSON-LD input and the options.
If you want to use some special context options, you may instantiate a ContextProcesser and pass it to their constructor.

#### Validation
To validate a JSON-LD file, instantiate a JsonLdValidator and call the `validate` method with the JSON-LD input, which must be a valid json string.
This method will return one ValidationMap for each detected root type. These maps expose 2 getters :
- `isValid` : Will return true if no validation errors were detected, false otherwise.
- `getTypes` : Will return a PHP representation of the provided JSON-LD document with all errors assigned to their properties and the line and column where they are located in the original JSON document.
- `getErrors` : returns all the errors found on the document. See the `MappedError` class for more informations about the errors.

## Testing

This library uses the [W3C test suite](https://github.com/w3c/json-ld-api/tree/main/tests) to test its algorithms.

Since this is a pretty big test suite, we didn't version it. The library will automatically download it when you run the tests with
```bash
castor test
```

We also provide a way of removing or resetting the test files if you have issues with them.
To remove them, run
```bash
castor fixtures:delete
```

To reset them, run
```bash
castor fixtures:reset
```
