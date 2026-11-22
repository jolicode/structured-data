# JSON-LD 1.1 algorithms

The library implements the W3C
[JSON-LD 1.1 Processing Algorithms and API](https://www.w3.org/TR/json-ld-api) and
[JSON-LD 1.1 Framing](https://www.w3.org/TR/json-ld11-framing/) Recommendations:

- [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor`
- [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander`
- [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener`
- [Framing](https://www.w3.org/TR/json-ld11-framing/#framing-algorithm): `JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer`
- [Deserialization to RDF](https://www.w3.org/TR/json-ld11-api/#deserialize-json-ld-to-rdf-algorithm) (`toRdf`): `JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter`
- [Serialization from RDF](https://www.w3.org/TR/json-ld11-api/#serialize-rdf-as-json-ld-algorithm) (`fromRdf`): `JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter`

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

## Documents given as a URL

Every algorithm takes the URL of a document where it takes a document, once the document
loader is [allowed to reach its host](remote-contexts.md):

```php
$expander = new Expander(documentLoader: new HttpDocumentLoader($policy, $httpClient));
$result = $expander->expand('https://example.com/data.jsonld');
```

- The base IRI is the URL the document was finally served from, redirections followed. The
  `base` option replaces it.
- A document served as `application/json` (or any `+json` type) with a
  `Link: <context.jsonld>; rel="http://www.w3.org/ns/json-ld#context"` header is processed
  with that context, applied before its own.
- A document that is not JSON and carries a
  `Link: <doc.jsonld>; rel="alternate"; type="application/ld+json"` header is replaced by
  the document the header points at.
- An **HTML document** gives the JSON-LD of its `<script type="application/ld+json">`
  elements: the first one by default, all of them with `extractAllScripts: true`, the one
  whose `id` the fragment of the URL names (`page.html#second`) otherwise. Its
  `<base href>` sets the base IRI. A script that does not hold a JSON document raises
  `invalid script element`. The deserialization to RDF takes every script by default.
- Any other content type is refused, as is a document that cannot be reached, with
  `loading document failed`.

To check the structured data of a page, markup errors included, use the
[validator](validator.md) instead: it reads JSON-LD, microdata and RDFa, tolerates what a
browser tolerates, and says where each problem is.

## RDF

`ToRdfConverter` turns a JSON-LD document into an `RdfDataset`, a set of `Quad` objects
whose terms are `Iri`, `BlankNode` and `Literal` values. `NQuadsSerializer` writes a dataset
as [N-Quads](https://www.w3.org/TR/n-quads/):

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;

$dataset = (new ToRdfConverter())->toRdf('{
  "@context": "https://schema.org",
  "@id": "https://example.com/john",
  "@type": "Person",
  "name": "John Doe"
}');

echo NQuadsSerializer::serialize($dataset);
```

```nquads
<https://example.com/john> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://schema.org/Person> .
<https://example.com/john> <http://schema.org/name> "John Doe" .
```

`FromRdfConverter` goes the other way. It takes an `RdfDataset` or an N-Quads string
(`NQuadsParser` reads one into a dataset) and returns the expanded JSON-LD document, as a
JSON string unless `encodeResult` is `false`:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter;

$document = (new FromRdfConverter())->fromRdf($nQuads, new ProcessorOptions(useNativeTypes: true));
```

Four options of `ProcessorOptions` only concern these two algorithms:

| Option | Default | Effect |
| --- | --- | --- |
| `produceGeneralizedRdf` | `false` | `toRdf` keeps the triples whose predicate is a blank node, which RDF does not allow. |
| `rdfDirection` | `null` | How the base direction of a string (`@direction`) travels through RDF, which has no room for it: dropped when `null`, written in the datatype with `i18n-datatype`, in a blank node with `compound-literal`. Use the same value both ways. |
| `useNativeTypes` | `false` | `fromRdf` turns `xsd:boolean`, `xsd:integer` and `xsd:double` literals into JSON booleans and numbers. A literal JSON cannot hold (an integer larger than a PHP integer, an infinity, an invalid lexical form) keeps its string and its `@type`. |
| `useRdfType` | `false` | `fromRdf` keeps `rdf:type` as an ordinary property instead of `@type`. |

A triple that would hold an IRI or a language tag that is not well-formed is left out of
the dataset, as the specification asks: `toRdf` does not report it. Numbers take their
canonical `xsd:integer` or `xsd:double` lexical form, and a JSON literal (`"@type": "@json"`)
is written with the [JSON Canonicalization Scheme](https://www.rfc-editor.org/rfc/rfc8785).

## Conformance

Each algorithm is validated against the official W3C test suites
([json-ld-api](https://github.com/w3c/json-ld-api) and
[json-ld-framing](https://github.com/w3c/json-ld-framing)), pinned to a known-good upstream
commit and re-run weekly against `main` to surface drift.

The full suites pass. The only skipped fixtures are a handful that target JSON-LD
1.0-specific behavior (declared `specVersion: json-ld-1.0` in the upstream manifest), which
this library does not implement; each skip is documented in the corresponding test.

As of the pinned upstream commits, the manifests list 1375 tests, and every test that
applies to a JSON-LD 1.1 processor passes:

| Suite | Passed | JSON-LD 1.0 only |
| --- | --- | --- |
| expand | 388 | 0 |
| compact | 245 | 2 |
| flatten | 58 | 0 |
| frame | 91 | 1 |
| toRdf | 457 | 11 |
| fromRdf | 53 | 1 |
| remote-doc | 18 | 0 |
| html | 50 | 0 |

These are the seven suites of the JSON-LD 1.1 API, and the framing one. The figures include
the optional features of the specification: generalized RDF, both `rdfDirection` forms, and
the extraction of JSON-LD from HTML documents.

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
castor json-ld:to-rdf <file> [--rdf-direction=i18n-datatype|compound-literal] [--generalized]
castor json-ld:from-rdf <n-quads-file> [--rdf-direction=...] [--native-types] [--rdf-type]
```
