# JSON-LD 1.1 algorithms

The library implements the W3C
[JSON-LD 1.1 Processing Algorithms and API](https://www.w3.org/TR/json-ld-api) and
[JSON-LD 1.1 Framing](https://www.w3.org/TR/json-ld11-framing/) Recommendations:

- [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor`
- [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander`
- [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener`
- [Framing](https://www.w3.org/TR/json-ld11-framing/#framing-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer`

Serialization to and from RDF (`toRdf` / `fromRdf`) is out of scope and not implemented.

## Usage

Create an instance of the algorithm and pass it the JSON-LD document you want to convert.
For instance, expanding a document:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;

$jsonString = '{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Doe"
}';

$expander = new Expander();
$result = $expander->expand($jsonString);
```

The result is a JSON string containing the expanded document:

```json
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

If you want a PHP value (an array or a `stdClass`) instead of a JSON string, set the
`encodeResult` parameter to `false`. You can also pass a `ProcessorOptions` object holding
the [JSON-LD options](https://www.w3.org/TR/json-ld-api/#the-jsonldoptions-type) to modify
the default behavior of the algorithms:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

$options = new ProcessorOptions(
  ordered: true,
  frameExpansion: true,
);

$expander = new Expander();
$result = $expander->expand($jsonString, options: $options, encodeResult: false);
```

Remote `@context` URLs other than schema.org are refused by default: see
[Loading remote contexts](remote-contexts.md).

## Conformance

Each algorithm is validated against the official W3C test suites
([json-ld-api](https://github.com/w3c/json-ld-api) and
[json-ld-framing](https://github.com/w3c/json-ld-framing)), pinned to a known-good upstream
commit and re-run weekly against `main` to surface drift.

The full suites pass. The only skipped fixtures are a handful that target JSON-LD
1.0-specific behavior (declared `specVersion: json-ld-1.0` in the upstream manifest), which
this library does not implement; each skip is documented in the corresponding test.

As of the pinned upstream commits, the manifests list 781 tests, and every test that
applies to a JSON-LD 1.1 processor passes:

| Suite | Passed | JSON-LD 1.0 only |
| --- | --- | --- |
| expand | 385 | 0 |
| compact | 244 | 2 |
| flatten | 58 | 0 |
| frame | 91 | 1 |

`castor qa:earl` runs these suites and writes an [EARL](https://www.w3.org/TR/EARL10-Schema/)
report in Turtle, one assertion per manifest entry, in the format the
[W3C JSON-LD implementation report](https://w3c.github.io/json-ld-api/reports/) consolidates.

## Command line interface

From a clone of this repository, with [Castor](https://github.com/jolicode/castor/)
installed, the algorithms are available from the command line. Each prints its output to
the console:

```bash
castor json-ld:expand <file>
castor json-ld:flatten <file>
castor json-ld:compact <file> <context-file>
castor json-ld:frame <file> <frame-file>
```
