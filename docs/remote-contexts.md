# Loading remote contexts

## By default, nothing goes out

A JSON-LD document may point its `@context` at a URL, and the specification requires
that URL to be resolved before the document can be expanded. This library resolves
`https://schema.org` (and its `http` and trailing-slash variants) from the vocabulary
files it ships with, so the most common case by far is covered without a single
outbound request.

Every other remote context is **refused**. `Validator::audit()`, the four algorithms and the deserialization to RDF
issue no network request and read no file unless you say otherwise, and a refused
context raises the error the specification mandates:

```
loading remote context failed
```

## Why unbounded resolution is dangerous

The `@context` URL comes from the document being processed. As soon as that document is
not fully under your control, the URL is attacker-controlled, and a loader that resolves
anything hands them:

- **Request forgery.** `http://127.0.0.1:9200/`, `http://169.254.169.254/latest/meta-data/`,
  or any host on your internal network, reachable from your server.
- **Network mapping.** Even without seeing the responses, the difference between a
  refusal, a timeout, and a success tells them which internal ports are open.
- **Exfiltration.** If the response body of a failed fetch ever finds its way back into
  an error message. This is why the message above is opaque: it discloses neither the
  body, nor the status code, nor the URL that was tried.
- **Denial of service.** Through a response that never ends or never arrives, or through
  a chain of contexts that each pull more contexts (`@import`, alternate locations,
  `Link rel="…json-ld#context"` headers).
- **Local file reads.** If a non-http scheme is allowed to reach the PHP stream wrappers:
  `file:///var/www/.env`, or `phar://`, which deserializes archive metadata on a mere
  stat call.

## Widening the policy, safely

If your documents legitimately reference contexts you trust, install an HTTP client
(`composer require symfony/http-client`), then allow those hosts, and nothing else:

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

The same constructor argument is available on `Expander`, `Compactor`, `Flattener` and `Framer`:

```php
$expander = new Expander(documentLoader: new HttpDocumentLoader($policy, $httpClient));
```

Host matching is exact, so allowing `schema.org` does not allow `evil.schema.org.example`.
A URL carrying userinfo (`https://user:pass@schema.org/`) or a non-default port
(`https://schema.org:8080/`) is refused. Only `http` and `https` may ever be allowed, and
`http` requires an explicit `withSchemes('http', 'https')`. The policy is re-checked on
every hop: the URL you asked for, **each intermediate redirect**, each alternate location,
each `Link` header, and the URL a response was ultimately served from.

The `@context` URL is not the only document-controlled value that can reach the loader:
`Expander::expand()` (and, through it, `Validator::audit()`) also accepts a bare IRI as its
input and will resolve it. That path is bound by the very same policy, so the default
deny-all loader refuses it too - but keep it in mind when you widen the allow-list.

## Writing your own loader

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

## Checklist

- List the allowed hosts explicitly, and keep the list short.
- Stay on `https` unless a context you genuinely must load is only available over `http`.
- Wrap your client in `NoPrivateNetworkHttpClient`.
- Set a timeout, a max duration, a response size cap and a redirect cap.
- Never return the body of a remote response to your users.
