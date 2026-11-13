# Benchmarks

The figures below come from `castor qa:bench:all`, run on 2026-11-13 on a developer
laptop, with PHP 8.5 in CLI, opcache and JIT disabled. They are
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
| 25 distinct variants of the Google *Book* fixture | 9 KB JSON-LD, 10 nested types | 12.7 ms | 20.6 MB |

The 25 documents took 318 ms in total (±0.25 %).

### The same document, again and again

These subjects audit the same document on every revolution. The extraction and
expansion results are cached by content, so they measure the validators and the
mapping more than the full pipeline, and they are the lower bound of what an audit
costs.

| Document | Size | Time per audit | Peak memory |
| --- | --- | --- | --- |
| schema.org fixture, a single type | 0.4 KB JSON-LD | 1.5 ms | 5.2 MB |
| schema.org fixture, nested types | 6 KB JSON-LD | 3.3 ms | 5.8 MB |
| Google *Book* fixture | 9 KB JSON-LD | 12.6 ms | 8.1 MB |
| jolicode.com homepage | 139 KB HTML | 6.8 ms | 6.6 MB |
| jolicampus.com homepage | 95 KB HTML | 5.5 ms | 6.5 MB |
| Google structured data introduction | 187 KB HTML | 10.5 ms | 6.5 MB |

The HTML pages are real pages, downloaded by `castor qa:phpunit:download-fixtures`
from hosts JoliCode owns or operates (plus the Google documentation page), and never
committed.

## JSON-LD algorithms

The inputs are fixtures of the W3C test suites, except where noted. The context
processor benchmarks measure the context processing step alone.

| Algorithm | Input | Time | Peak memory |
| --- | --- | --- | --- |
| Context processing | inline context | 11 µs | 3.9 MB |
| Context processing | scoped contexts | 24 µs | 3.9 MB |
| Context processing | nested contexts | 12 µs | 3.9 MB |
| Expansion | minimal document (`expand/0002`) | 224 µs | 3.9 MB |
| Expansion | context-heavy document (`expand/0036`) | 409 µs | 3.9 MB |
| Expansion | nested `@graph` (`expand/pr25`) | 829 µs | 3.9 MB |
| Expansion | 8 nodes each repeating the schema.org context | 3.1 ms | 5.1 MB |
| Compaction | inline context | 215 µs | 3.9 MB |
| Compaction | into the schema.org context | 13.4 ms | 10.2 MB |
| Flattening | minimal document | 266 µs | 3.9 MB |
| Flattening | nested lists | 600 µs | 3.9 MB |
| Framing | by type, schema.org context | 16.2 ms | 10.5 MB |
| Framing | embedded node, schema.org context | 16.2 ms | 10.5 MB |

Compaction into the schema.org context and framing with it both cost around 15 ms:
that is the price of building the inverse context of the roughly 3,000 schema.org
terms, which the other subjects never need. Expanding *with* the schema.org context
is cheap in comparison, because the processed context is served from the static
vocabulary files the library ships with. The "repeated remote context" subject is the
regression guard for that path.

## Reproducing

```bash
castor qa:install                      # phpbench and the other QA tools
castor qa:phpunit:prepare              # the W3C test suites
castor qa:phpunit:download-fixtures    # the HTML pages
castor qa:bench:all
```

`castor qa:bench:validators -d` additionally breaks the HTML pipeline down step by
step (format detection, extraction, parsing, mapping, validation); it is slow.

For finer time units than the default seconds, call PHPBench directly:

```bash
tools/phpbench/vendor/bin/phpbench run tests/Algorithms/Benchmark --report=readable --time-unit=microseconds
tools/phpbench/vendor/bin/phpbench run tests/Validation/Benchmark/JsonLdValidatorBench.php tests/Validation/Benchmark/WorkerValidationBench.php --report=readable --time-unit=milliseconds
```

For the record, the full PHPUnit suite (1,496 tests, 3,317 assertions, W3C suites
included) runs in about 20 seconds on the same machine.
