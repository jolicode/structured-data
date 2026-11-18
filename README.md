<h1 align="center">
  <a href="https://github.com/jolicode/structured-data"><img src="https://jolicode.com/media/original/oss/headers/template.png" alt="Structured Data Toolkit"></a>
  <br />
  Structured Data Toolkit
  <br />
  <sub><em><h6>JSON-LD and schema.org for PHP</h6></em></sub>
</h1>

<div align="center">

[![CI](https://github.com/jolicode/structured-data/actions/workflows/ci.yml/badge.svg)](https://github.com/jolicode/structured-data/actions/workflows/ci.yml)
[![W3C JSON-LD 1.1 test suites](https://img.shields.io/badge/W3C_JSON--LD_1.1-test_suites_passing-brightgreen)](docs/json-ld.md#conformance)
[![PHPStan level 9](https://img.shields.io/badge/PHPStan-level_9-brightgreen)](phpstan.neon)
[![PHP Version Require](http://poser.pugx.org/jolicode/structured-data/require/php)](https://packagist.org/packages/jolicode/structured-data)
[![License](http://poser.pugx.org/jolicode/structured-data/license)](LICENSE)

</div>

Validate and process structured data in PHP: check that your [schema.org](https://schema.org/)
markup is valid and eligible for
[Google Rich Results](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data),
from JSON-LD, microdata or RDFa, without leaving your process. It also ships an
implementation of the W3C JSON-LD 1.1 algorithms that passes the official test suites.
The [W3C implementation report](https://w3c.github.io/json-ld-api/reports/)
lists no other PHP processor.

**[Try it in your browser](https://structured-data-validator.jolicode.com/)**, or see it at
work in [redirection.io](https://redirection.io/), which audits the structured data of
every page it crawls with it.

## Why this library

- **Google Rich Results checks, offline**: 36 types, including the rules Google only states in prose, applied to subtypes and nested entities.
- **Exact JSON-LD 1.1**: the W3C test suites pass, so documents are validated on what they mean, not on how they are written.
- **One pipeline** for JSON-LD, microdata and RDFa found in an HTML page.
- **Safe on untrusted pages**: no network request or file read unless you allow-list it, hostile input refused instead of crashing.
- **Built for workers**: bounded memory, about 13 ms for a heavy document ([benchmarks](BENCHMARKS.md)).
- **Actionable diagnostics**: severity, path in the document, line range, and a link to the Google documentation.
- **Auditable rules**: generated from the official schema.org release and the Google documentation, drift-checked weekly.

## How it compares

| Tool | What it does | Difference |
| --- | --- | --- |
| [Rich Results Test](https://search.google.com/test/rich-results) | Google eligibility check | Browser only, no API |
| [Schema Markup Validator](https://validator.schema.org/) | schema.org vocabulary check | Browser only, no Google rules |
| [spatie/schema-org](https://github.com/spatie/schema-org) | Writes JSON-LD | No validation: use this library to check its output |
| [brick/schema](https://github.com/brick/schema), [crwlrsoft/schema-org](https://github.com/crwlrsoft/schema-org) | Read structured data into PHP objects | Accept whatever they find, no validation |
| [ml/json-ld](https://github.com/lanthaler/JsonLD), [digitalbazaar/php-json-ld](https://github.com/digitalbazaar/php-json-ld) | JSON-LD 1.0 processors | 1.0 only, load remote contexts by default |

## Installation

```bash
composer require jolicode/structured-data
```

Requires PHP 8.4 or later, with the `dom`, `json` and `libxml` extensions.

## Usage

### Validate a page or a JSON-LD document

```php
use JoliCode\StructuredData\Validator;

$validator = new Validator();
$audit = $validator->audit($html); // the document itself, never a URL or a file path

$audit->isValid();      // no errors
$audit->isFullyValid(); // no errors, no warnings

foreach ($audit->getDiagnostic() as $message) {
    echo $message;
    // [Google warning] DataFeed.dataFeedElement.workExample: Missing recommended property: "sameAs" for the type "Book"
}
```

A few options:

```php
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;

$validator->setValidator(GoogleValidator::class);               // run a single validator
$validator->audit($html, mergeNodesSharingAnIdentifier: false); // audit blocks sharing an @id separately
$validator->audit($html, reportPendingVocabularyUsage: true);   // warn on pending.schema.org terms
```

More in [the validator documentation](docs/validator.md): filtering diagnostics, merged
nodes, the parsed tree, and the CLI.

### Use the JSON-LD algorithms

Expansion, compaction, flattening and framing are available as `Expander`, `Compactor`,
`Flattener` and `Framer`:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;

$expanded = (new Expander())->expand('{"@context": "https://schema.org", "@type": "Person", "name": "John Doe"}');
```

See [the JSON-LD documentation](docs/json-ld.md) for the options and the conformance report.

### Remote contexts

`https://schema.org` contexts are resolved from bundled files. Any other remote `@context` is
refused by default. To allow some hosts, install `symfony/http-client` and pass an
allow-list:

```php
$policy = RemoteContextPolicy::allowHosts('www.w3.org', 'json-ld.org');
$validator = new Validator(documentLoader: new HttpDocumentLoader($policy, $httpClient));
```

Read [Loading remote contexts](docs/remote-contexts.md) before widening the policy.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for the setup, the QA commands and the vocabulary
upgrade procedures.

## License

This library is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.

<br><br>
<div align="center">
<a href="https://jolicode.com/"><img src="https://jolicode.com/media/original/oss/footer-github.png?v3" alt="JoliCode is sponsoring this project"></a>
</div>
