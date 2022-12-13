## Welcome to the JoliCode JSON-LD implementation !

This repository is a PHP implementation of the JSON-LD processing algorithms.
More informations about the JSON-LD format are available on the [official website](https://json-ld.org/).

Informations about the algorithms are available in the [W3C documentation](https://www.w3.org/TR/json-ld11-api/). This library is an implementation of these recommendations, although we also took inspiration from [the Javascript Library](https://github.com/digitalbazaar/jsonld.js), which also follows the W3C recommendations.

## Testing

This library uses the [W3C test suite](https://github.com/w3c/json-ld-api/tree/main/tests) to test its algorithms.

Since this is a pretty big test suite, we didn't version it. The library will automatically download it when you run the tests with
```
make test
```

(don't forget to run `composer install` or `make install` first to install the dependencies !)

We also provide a way of removing or resetting the test files if you have issues with them.
To remove them, run
```
make delete_test
```

To reset them, run
```
make reset_test
```

## Dependencies

This library requires the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php).
