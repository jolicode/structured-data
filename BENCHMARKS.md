# Benchmarks

The figures below come from `castor qa:bench:all`, run on 2026-11-21 on a developer
laptop, with PHP 8.5 in CLI, opcache and JIT disabled, and Composer's optimized
autoloader. They are
[PHPBench](https://github.com/phpbench/phpbench) *mode* values: the most frequent
measurement over the iterations, with the relative standard deviation next to it.
Memory is the peak of the benchmark process. Take them as orders of magnitude: the
CI runs below are the reference to compare against over time.

The same benchmarks run every Sunday in CI, on PHP 8.4 and 8.5, and their HTML reports
are attached to the scheduled run as the `benchmark-reports-php*` artifacts.

## Validating documents

`Validator::audit()` runs the whole pipeline: extraction of the JSON-LD, microdata and
RDFa blocks, JSON-LD expansion, mapping to the schema.org vocabulary, then the
schema.org and Google validators.

### A stream of distinct documents

This is the figure to quote for a crawler, a queue consumer or any long-lived process:
one `Validator` audits 25 documents that all differ from each other, so no
content-keyed cache can serve them.

| Scenario | Document | Time per document | Peak memory |
| --- | --- | --- | --- |
| 25 distinct variants of the Google *Book* fixture | 9 KB JSON-LD, 10 nested types | 13.2 ms | 20.8 MB |

The 25 documents took 330 ms in total (±2.36 %).

### The same document, again and again

These subjects audit the same document on every revolution. The extraction and
expansion results are cached by content, so they measure the validators and the
mapping more than the full pipeline, and they are the lower bound of what an audit
costs.

| Document | Size | Time per audit | Peak memory |
| --- | --- | --- | --- |
| schema.org fixture, a single type | 0.4 KB JSON-LD | 1.6 ms | 5.2 MB |
| schema.org fixture, nested types | 6 KB JSON-LD | 4.0 ms | 6.2 MB |
| Google *Book* fixture | 9 KB JSON-LD | 13.1 ms | 8.2 MB |
| jolicode.com homepage | 139 KB HTML | 7.1 ms | 6.6 MB |
| jolicampus.com homepage | 95 KB HTML | 5.9 ms | 6.5 MB |
| Google structured data introduction | 187 KB HTML | 10.9 ms | 6.6 MB |

The HTML pages are real pages, downloaded by `castor qa:phpunit:download-fixtures`
from hosts JoliCode owns or operates (plus the Google documentation page), and never
committed.

## JSON-LD algorithms

The inputs are fixtures of the W3C test suites, except where noted. The context
processor benchmarks measure the context processing step alone.

| Algorithm | Input | Time | Peak memory |
| --- | --- | --- | --- |
| Context processing | inline context | 11 µs | 3.9 MB |
| Context processing | scoped contexts | 25 µs | 3.9 MB |
| Context processing | nested contexts | 12 µs | 3.9 MB |
| Expansion | minimal document (`expand/0002`) | 224 µs | 3.9 MB |
| Expansion | context-heavy document (`expand/0036`) | 412 µs | 3.9 MB |
| Expansion | nested `@graph` (`expand/pr25`) | 837 µs | 3.9 MB |
| Expansion | 8 nodes each repeating the schema.org context | 3.2 ms | 5.1 MB |
| Compaction | inline context | 215 µs | 3.9 MB |
| Compaction | into the schema.org context | 13.8 ms | 10.2 MB |
| Flattening | minimal document | 264 µs | 3.9 MB |
| Flattening | nested lists | 600 µs | 3.9 MB |
| Framing | by type, schema.org context | 16.3 ms | 10.5 MB |
| Framing | embedded node, schema.org context | 16.3 ms | 10.5 MB |
| Deserialization to RDF | minimal document (`toRdf/0002`) | 126 µs | 3.9 MB |
| Deserialization to RDF | list (`toRdf/0036`) | 182 µs | 3.9 MB |
| Deserialization to RDF | nested `@graph` (`toRdf/pr25`) | 987 µs | 3.9 MB |
| Deserialization to RDF | JSON literal (`toRdf/js12`) | 182 µs | 3.9 MB |
| Deserialization to RDF | 8 schema.org nodes, written as N-Quads | 1.5 ms | 5.2 MB |
| Serialization from RDF | minimal dataset (`fromRdf/0002`) | 87 µs | 3.9 MB |
| Serialization from RDF | lists (`fromRdf/li03`) | 274 µs | 3.9 MB |
| Serialization from RDF | native types (`fromRdf/0027`) | 184 µs | 3.9 MB |
| Serialization from RDF | 1,600 statements, read from N-Quads | 15.7 ms | 6.4 MB |
| Serialization from RDF | the same 1,600 statements, already parsed | 5.6 ms | 5.3 MB |

Compaction into the schema.org context and framing with it both cost around 15 ms:
that is the price of building the inverse context of the roughly 3,000 schema.org
terms, which the other subjects never need. Expanding *with* the schema.org context
is cheap in comparison, because the processed context is served from the static
vocabulary files the library ships with. The "repeated remote context" subject is the
regression guard for that path.

The deserialization to RDF is an expansion followed by the node map generation: on the
nested `@graph` document it costs 18 % more than the expansion alone. The serialization from RDF takes an
`RdfDataset` or N-Quads: on the 1,600 statements dataset, reading the N-Quads is two
thirds of the time (about 6 µs per statement), the algorithm itself the last third
(about 3.5 µs per statement).

## Reproducing

```bash
castor qa:install                      # phpbench and the other QA tools
castor qa:phpunit:prepare              # the W3C test suites
castor qa:phpunit:download-fixtures    # the HTML pages
composer dump-autoload -o              # the optimized autoloader the figures are taken with
castor qa:bench:all
```

`castor qa:bench:validators -d` additionally breaks the HTML pipeline down step by
step (format detection, extraction, parsing, mapping, validation); it is slow.

The autoloader matters: without the optimized class map, the audits of a single document
are 2 to 10 % slower and the peak memory figures are 1.3 to 3 MB lower, the class map of
the 3,000 generated vocabulary classes not being loaded.

For finer time units than the default seconds, call PHPBench directly:

```bash
tools/phpbench/vendor/bin/phpbench run tests/Algorithms/Benchmark --report=readable --time-unit=microseconds
tools/phpbench/vendor/bin/phpbench run tests/Validation/Benchmark/JsonLdValidatorBench.php tests/Validation/Benchmark/WorkerValidationBench.php --report=readable --time-unit=milliseconds
```

For the record, the full PHPUnit suite (2,281 tests, 4,802 assertions, W3C suites
included) runs in about 20 seconds on the same machine.
