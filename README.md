# Structured Data — JSON-LD & schema.org for PHP

[![CI](https://github.com/jolicode/structured-data/actions/workflows/ci.yml/badge.svg)](https://github.com/jolicode/structured-data/actions/workflows/ci.yml)
[![Latest version](https://img.shields.io/packagist/v/jolicode/structured-data.svg)](https://packagist.org/packages/jolicode/structured-data)
[![PHP version](https://img.shields.io/packagist/php-v/jolicode/structured-data.svg)](https://packagist.org/packages/jolicode/structured-data)
[![License](https://img.shields.io/packagist/l/jolicode/structured-data.svg)](LICENSE)

This library provides several tools to work with [JSON-LD](https://json-ld.org/) and [schema.org](https://schema.org/) in PHP.
It includes:
- an implementation of the W3C JSON-LD algorithms described in the [JSON-LD 1.1 Processing Algorithms and API Recommendation](https://www.w3.org/TR/json-ld-api) published on July 16th, 2020.
- a Schema.org validator.
- a Google validator, able to tell if your JSON-LD is eligible for [Google Rich Results](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data).
- extraction of JSON-LD, microdata and RDFa from HTML documents.

## Installation

Install the library with [Composer](https://getcomposer.org/):

```bash
composer require jolicode/structured-data
```

Resolving remote `@context` documents is **off by default** and needs no extra
dependency. If you opt into it (see [Loading remote contexts](#loading-remote-contexts)),
also install an HTTP client:

```bash
composer require symfony/http-client
```

## Dependencies

This library requires:

- PHP >= 8.4, with the `dom`, `json` and `libxml` extensions
- (optional, only for remote `@context` resolution) an implementation of `symfony/http-client-contracts`, such as [`symfony/http-client`](https://symfony.com/doc/current/http_client.html)
- (optional) the PHP task runner [Castor](https://github.com/jolicode/castor/), used for the tooling and the CLI interface. The development tooling additionally needs the [ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php) to download the W3C test suites.

## Working on the library

Clone the repository, then install the library's dependencies and the QA tooling:

```bash
composer install   # the library's own dependencies (Composer, not Castor)
castor install     # the QA tooling: php-cs-fixer, phpstan, phpunit, phpbench, infection
```

## Validating a JSON-LD document

To validate a JSON-LD document, you must use the `JoliCode\StructuredData\Validator` class.

### Accepted inputs

`audit()` takes **the document itself**, as a string — never a URL, never a file path.

This library deliberately does not guess what a string is, and never fetches anything on
your behalf. Guessing is a security hazard: an application that forwards user input to a
validator would silently offer an attacker a way to reach its internal network
(`http://127.0.0.1:9200/`, cloud metadata endpoints), or to read local files through a
path or a stream wrapper (`/var/www/.env`, `file://`, `phar://`).

Whether a document may be fetched, from where, and under which restrictions, is a decision
only your application can make. So it makes it:

```php
// From a local file - the path comes from you, not from a user
$document = file_get_contents('/path/to/document.html');

// From the network - your HTTP client, your allow-list, your timeouts
$document = $httpClient->request('GET', $trustedUrl)->getContent();

$audit = $validator->audit($document);
```

The same rule applies to the `@context` URLs found *inside* a document: see
[Loading remote contexts](#loading-remote-contexts).

The validator accepts the following data formats:
- json-ld
- microdata
- RDFa (schema.org style RDFa only)

### Using the validator

#### Basic usage

The validator exposes a single validation method: `audit()`.
It returns a `JoliCode\StructuredData\Audit\Audit` object holding the validation result.

To quickly check the result, use either of `isValid()` or `isFullyValid()`:
- `isValid` returns true if no errors are detected
- `isFullyValid` returns true if no errors, no warnings, and no malformed data structures (i.e. unusable) were detected

**Keep it mind that a schema.org type is considered valid even with warnings!**

To access the error messages themselves, use the `getDiagnostic()` method, which will return an array of error messages.

A pretty classic usage example would be doing something like this:

```php
use JoliCode\StructuredData\Validator;

$validator = new Validator();

$document = file_get_contents('/path/to/a-page.html');
$audit = $validator->audit($document);

if (!$audit->isValid()) {
  echo 'The provided document contains non-valid schema.org data!';

  // Returns an array of string error messages
  $diagnostic = $audit->getDiagnostic();

  foreach ($diagnostic as $message) {
    // Will look like this
    // [Google warning] DataFeed.dataFeedElement.workExample: Missing recommended property: "sameAs" for the type "Book"
    // [Google error] DataFeed.dataFeedElement.workExample.potentialAction.expectsAcceptanceOf: Missing required property: "price" for the type "Offer" when "category" is "purchase" or "rental".
    echo $message;
  }
} else {
  echo 'The JSON-LD document is valid!';
}
```

If you are only interested by the results of one validator, you can call `setValidator` first to set the desired validator:
```php
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;

$validator = new Validator();
$validator->setValidator(GoogleValidator::VALIDATOR_NAME);

$validator->audit($document);
```

#### Advanced Usage

The `getDiagnostic()` method accepts an optional parameter: a `JoliCode\StructuredData\Audit\AuditOptions` object, allowing you to filter or group the result, or to have a different return format. See the PHPDoc on `JoliCode\StructuredData\Audit\AuditOptions` for more details.

Finally, if you want to access the full parsed PHP tree, use `getTypes()` and inspect the underlying `MappedType` objects directly. These are low-level objects, but they are the most detailed informations you can get, and they respect the inheritance of the document.
To have an idea of what you can do with these objects, check the output of the `validate()` castor command.

### Command Line Interface

A command is available to quickly validate a JSON-LD document from the CLI or the CI: `check()`.
Use the `validate()` command to get a nicely parsed and colored full audit (it can be pretty verbose!).
Both will return an explicit process exit code for scripting/CI usage.

```bash
castor check <file-or-url>
castor validate <file-or-url>
```

Unlike the `Validator::audit()` API, these CLI commands **do** accept a file path or a
URL, and will read or fetch it for you. That is safe here precisely because the argument
comes from the operator running the command, not from a document being processed — the
distinction the [Accepted inputs](#accepted-inputs) section is about.

You can validate using a specific validator:

```bash
castor validate <file-or-url> google
```

```bash
castor validate <file-or-url> schema-org
```

Sample result of the validate command:
<img width="822" height="749" alt="Screenshot from 2026-05-05 14-38-31" src="https://github.com/user-attachments/assets/97912eb8-1e11-4ba9-8cc1-ac0b6248d816" />


## Using the JSON-LD algorithms

The currently available algorithms are:

- [x] [Compaction](https://www.w3.org/TR/json-ld11-api/#compaction-algorithm)
- [x] [Expansion](https://www.w3.org/TR/json-ld11-api/#expansion-algorithm)
- [x] [Flattening](https://www.w3.org/TR/json-ld11-api/#flattening-algorithm)
- [x] [Framing](https://www.w3.org/TR/json-ld11-framing/#framing-algorithm)

### Conformance

Each algorithm is validated against the official W3C test suites ([json-ld-api](https://github.com/w3c/json-ld-api) and [json-ld-framing](https://github.com/w3c/json-ld-framing)), pinned to a known-good upstream commit and re-run weekly against `main` to surface drift.

The full suites pass, covering expansion, compaction, flattening and framing. The only skipped fixtures are a handful that target JSON-LD 1.0-specific behaviour (declared `specVersion: json-ld-1.0` in the upstream manifest), which this library does not implement; each skip is documented in the corresponding test. Serialization to and from RDF (`toRdf` / `fromRdf`) is out of scope and not implemented.

To use them, initialize a new instance of the `JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander`, `JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener`, `JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor` or `JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer` classes, and pass them the JSON-LD document you want to convert.

So, to expand a JSON-LD document you would need to do the following:

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

If you want a PHP object instead of a JSON string, set the `encodeResult` parameter to false when calling `expand()`.
You can also pass a `ProcessorOptions` object holding the [JSON-LD options](https://www.w3.org/TR/json-ld-api/#the-jsonldoptions-type) if you want to modify the default behavior of the algorithms:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

$jsonString = '{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Doe"
}';

$options = new ProcessorOptions(
  ordered: true,
  frameExpansion: true,
);

$expander = new Expander();
$result = $expander->expand($jsonString, options: $options, encodeResult: false);
```

### Loading remote contexts

#### By default, nothing goes out

A JSON-LD document may point its `@context` at a URL, and the specification requires
that URL to be resolved before the document can be expanded. This library resolves
`https://schema.org` (and its `http`, and trailing-slash variants) from the vocabulary
files it ships with, so the overwhelmingly common case is covered without a single
outbound request.

Every other remote context is **refused**. `Validator::audit()` and the four algorithms
issue no network request and read no file unless you say otherwise, and a refused
context raises the error the specification mandates:

```
loading remote context failed
```

#### Why unbounded resolution is dangerous

The `@context` URL comes from the document being processed. As soon as that document is
not fully under your control, the URL is attacker controlled, and a loader that resolves
anything hands them:

- **Request forgery.** `http://127.0.0.1:9200/`, `http://169.254.169.254/latest/meta-data/`,
  or any host on your internal network, reachable from your server.
- **Network mapping.** Even without seeing the responses, the difference between a
  refusal, a timeout, and a success tells them which internal ports are open.
- **Exfiltration**, if the response body of a failed fetch ever finds its way back into
  an error message. This is why the message above is opaque: it discloses neither the
  body, nor the status code, nor the URL that was tried.
- **Denial of service**, through a response that never ends or never arrives, or through
  a chain of contexts that each pull more contexts (`@import`, alternate locations,
  `Link rel="…json-ld#context"` headers).
- **Local file reads**, if a non-http scheme is allowed to reach the PHP stream wrappers:
  `file:///var/www/.env`, or `phar://`, which deserializes archive metadata on a mere
  stat call.

#### Widening the policy, safely

If your documents legitimately reference contexts you trust, allow those hosts, and
nothing else:

```php
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteContextPolicy;
use JoliCode\StructuredData\Validator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\NoPrivateNetworkHttpClient;

// 1. Which hosts do you trust? An explicit list, over https only.
$policy = RemoteContextPolicy::allowHosts('schema.org', 'www.w3.org', 'json-ld.org')
    ->withTimeouts(timeout: 2.0, maxDuration: 5.0)
    ->withMaxResponseBytes(512 * 1024)
    ->withMaxRedirects(3);

// 2. A second barrier, at the transport level: no private, loopback or link-local
//    address, even if a hostile DNS answer points an allowed host at 169.254.169.254.
$httpClient = new NoPrivateNetworkHttpClient(HttpClient::create());

// 3. A single injection point covers the whole chain.
$validator = new Validator(documentLoader: new HttpDocumentLoader($policy, $httpClient));
$audit = $validator->audit($document);
```

The same argument exists on `Expander`, `Compactor`, `Flattener` and `Framer`:

```php
$expander = new Expander(documentLoader: new HttpDocumentLoader($policy, $httpClient));
```

Host matching is exact, so allowing `schema.org` does not allow `evil.schema.org.example`.
A URL carrying userinfo (`https://user:pass@schema.org/`) or a non-default port
(`https://schema.org:8080/`) is refused. Only `http` and `https` may ever be allowed, and
`http` requires an explicit `withSchemes('http', 'https')`. The policy is re-checked on
every hop: the URL you asked for, **each intermediate redirect**, each alternate location,
each `Link` header, and the URL a response was ultimately served from. As an additional
barrier against a hostile DNS answer pointing an allowed host at an internal address, wrap
your client in `NoPrivateNetworkHttpClient` as shown above.

The `@context` URL is not the only document-controlled value that can reach the loader:
`Expander::expand()` (and, through it, `Validator::audit()`) also accepts a bare IRI as its
input and will resolve it. That path is bound by the very same policy, so the default
deny-all loader refuses it too — but keep it in mind when you widen the allow-list.

#### Writing your own loader

Implement `JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface` to resolve contexts
your own way, for instance from a local mirror or a PSR-6 cache:

```php
interface DocumentLoaderInterface
{
    public function load(string $url): \stdClass;

    public function getCacheNamespace(): string;
}
```

Processed contexts are cached for the lifetime of the process, and `getCacheNamespace()`
partitions that cache. Return a value that identifies what your loader is willing to
resolve, so that a context obtained under a permissive strategy can never be served to a
restrictive one. Signal every failure with
`new ContextProcessingException('loading remote context failed')`, and never put anything
from the remote response in that message.

#### Checklist

- List the allowed hosts explicitly, and keep the list short.
- Stay on `https` unless a fixture genuinely forces otherwise.
- Wrap your client in `NoPrivateNetworkHttpClient`.
- Set a timeout, a max duration, a response size cap and a redirect cap.
- Never return the body of a remote response to your users.

### Command Line Interface

Commands are also available to use the algorithms from the CLI :

```bash
castor json-ld:expand <file>
castor json-ld:flatten <file>
castor json-ld:compact <file> <context-file>
castor json-ld:frame <file> <frame-file>
```

They will print the output in the console.

## Testing and QA commands

The following commands are available to run the QA checks:

Command | Description | Aliases
---- | ----- | -----
`castor qa:cs` | Fix CS | `castor cs`
`castor qa:phpstan` | Runs PHPStan | `castor phpstan`
`castor qa:all` | Runs all QA tasks

The following commands are available to run the tests:

Command | Description | Aliases
---- | ----- | ----
`castor qa:phpunit:prepare` | Download the W3C tests suite
`castor qa:phpunit:run` | Runs PHPUnit | `castor test`, `castor tests`
`castor qa:phpunit:coverage` | Runs PHPUnit with code coverage (requires the pcov or xdebug extension) | `castor coverage`
`castor qa:infection` | Runs Infection mutation testing on the validator and mapper layers (requires the pcov or xdebug extension) | `castor infection`

The W3C test suite is pinned to a known-good upstream commit (see `W3C_TEST_SUITE_REF` in `tools/castor.php`).
To re-download it, or to test against the upstream main branch:

```bash
castor qa:phpunit:prepare --force
castor qa:phpunit:prepare --force --ref main
```

Additional commands are available to run the benchmarks:

Command | Description | Aliases
---- | ----- | ----
`castor qa:bench:all` | Run all the benchmarks | `castor bench`
`castor qa:bench:algorithms` | Run the JSON-LD manipulation algorithms benchmark
`castor qa:bench:validators` | Run the validators benchmark
`castor qa:bench:validators -d` | Run the detailed and slow validators benchmark

## Contributing

See the [CONTRIBUTING.md](CONTRIBUTING.md) file for more information.

### Upgrading Schema.org

Schema.org upgrades are driven by the official schema.org release definition file.
The complete upgrade process is documented in:
[resources/schema.org/UPGRADE_GUIDELINES.md](resources/schema.org/UPGRADE_GUIDELINES.md)

When upgrading, always review the [schema.org release notes](https://schema.org/docs/releases.html) and verify that the test schema-org-baseline.json changes reflect real Schema.org changes.

### Upgrading Google

The Google validator tracks the [Google structured-data documentation](https://developers.google.com/search/docs/advanced/structured-data/intro-structured-data), which evolves continuously.
The complete upgrade process is documented in:
[resources/google/UPGRADE_GUIDELINES.md](resources/google/UPGRADE_GUIDELINES.md)

## License

This library is released under the MIT License. See the bundled [LICENSE](LICENSE)
file for details.
