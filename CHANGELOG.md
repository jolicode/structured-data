# Changelog

## [Unreleased]

### Added

- The RDF serialization and deserialization algorithms of JSON-LD 1.1: `ToRdfConverter`
  turns a JSON-LD document into an `RdfDataset`, `FromRdfConverter` turns a dataset or
  N-Quads into an expanded document, and `NQuadsParser` / `NQuadsSerializer` read and
  write N-Quads. Generalized RDF, both `rdfDirection` forms, native types and JSON
  literals (canonicalized with RFC 8785) are supported. The official `toRdf` and `fromRdf`
  test suites pass, and are part of `castor qa:earl`. From the command line:
  `castor json-ld:to-rdf` and `castor json-ld:from-rdf`. See [docs/json-ld.md](docs/json-ld.md#rdf).
- A document given to an algorithm as a URL may be an HTML page: the JSON-LD of its
  `<script type="application/ld+json">` elements is extracted, the first one by default,
  all of them with the `extractAllScripts` option, or the one the fragment of the URL
  names. `<base href>` sets the base IRI. A URL is accepted as it is, where it had to be
  written as a JSON string.
- The official `remote-doc` and `html` test suites pass, and are part of `castor qa:earl`:
  the seven suites of the JSON-LD 1.1 API are now covered. See
  [docs/json-ld.md](docs/json-ld.md#documents-given-as-a-url).

### Changed

- **Breaking**: `DocumentLoaderInterface::load()` now takes a `LoadDocumentOptions` and
  returns a `RemoteDocument` instead of a `stdClass`, as the specification describes it:
  the document, the URL it finally comes from, its content type and the context an HTTP
  `Link` header names. A custom loader has to be adapted, see
  [docs/remote-contexts.md](docs/remote-contexts.md#writing-your-own-loader). It signals a
  failure with a `DocumentLoadingException`.
- **Breaking**: a remote response is only read when its `Content-Type` is
  `application/ld+json`, `application/json`, a `+json` type, or HTML for a document. A
  context served as `text/plain` or without a content type, read until now, is refused.
- A document that cannot be loaded from the URL an algorithm was given raises
  `loading document failed`, and several `Link` context headers raise
  `multiple context link headers`, where both raised `loading remote context failed`. A
  context that cannot be loaded still raises `loading remote context failed`.
- The base IRI of a document loaded from a URL is the URL it was finally served from,
  redirections followed, and the `base` option replaces it. It was the requested URL, which
  the option could not replace.
- The context an HTTP `Link` header names is applied before the context of the document,
  which it used to replace, and is ignored for a document served as `application/ld+json`.
- An `alternate` link to a JSON-LD document is only followed from a response that is not
  JSON. It was followed from `application/json` too.
- Flattening with a context always puts its result in a `@graph` entry, as the
  specification asks, including when a single node is left. The node used to sit at the top
  level in that case.
- `Flattener::flatten()` applies the `expandContext` option and refuses a string that is
  not JSON, like the other algorithms.
- `ProcessorOptions::$extractAllScripts` is nullable: `null` lets the algorithm decide.
- `ProcessorOptions::$produceGeneralizedRdf` now defaults to `false`, as the specification
  says. Nothing read the option before.
- **Breaking**: microdata and RDFa are read with the HTML5 parser of PHP 8.4
  (`Dom\HTMLDocument`) instead of libxml's HTML 4 one. `HtmlDocumentLoader::load()` returns a
  `Dom\HTMLDocument` and no longer takes a format name, and the protected helpers of
  `AbstractHtmlExtractor` take a `Dom\Element`: a custom HTML extractor has to follow.
  Parsing a page is about 2.5 times faster.
- Relative IRIs are resolved as RFC 3986 section 5.2 describes it and nothing more, as
  JSON-LD asks: non-ASCII characters are no longer percent-encoded, the host keeps its
  case, and a reference without a path keeps the dot segments of the base (`?y` against
  `http://a/b/./c` is `http://a/b/./c?y`). The resolution is the one of
  `League\Uri\UriString`, so the library now requires `league/uri-interfaces ^7.10`
  instead of `league/uri`.

### Fixed

- Microdata and RDFa values of a page that declares no encoding are read as UTF-8. They
  were read as ISO-8859-1, which turned `Zoé` into `ZoÃ©`.
- A microdata or RDFa element is located on the line its start tag opens on. It was
  located on the line the tag ends on, wrong for a tag written over several lines.
- Expanding an array that holds a map with nothing but `@graph` flattened that graph into
  the array: it is now kept as a graph object, only the document itself being unwrapped.
- A remote document that is a JSON array was turned into an object with numeric keys.
- Expansion reported `invalid @reverse property value` where the specification names the
  error `invalid reverse property value` (W3C test `expand#ter34`).
- Flattening and framing merged a plain string into a language-tagged string holding the
  same text when both were values of the same property: only one of the two was kept.

## [0.3.0] - 2026-11-13

### Added

- The blocks of a document that share an identifier (a JSON-LD `@id`, a microdata
  `itemid`) describe one node for Google, whatever their format, with the union of their
  properties. The audit now merges them into one item, validated as a whole: a property one
  block omits is no longer reported missing when another block provides it, and the issues
  of the node are reported once. `Audit::getItems()` lists the items, each with its node
  and its source blocks, which keep their own audit; `Audit::getTypes()` still lists the
  blocks. Values the blocks disagree on are a warning of the merged item (validator
  `Merge`, `AuditOptions::VALIDATOR_MERGE`), since Google keeps them all. The merge is on
  by default; pass `mergeNodesSharingAnIdentifier: false` to `Validator::audit()`, or
  `--no-merge` to `castor validate` and `castor check`, to audit every block on its own.
- `castor qa:earl` runs the W3C test suites and writes the EARL conformance report
  consolidated by the W3C JSON-LD implementation report. The W3C manifests are now kept
  with the downloaded test suites.
- `BENCHMARKS.md` documents the benchmark figures and what each of them measures.
  `castor qa:bench:validators` now also runs the worker benchmark, which audits a stream
  of distinct documents and is the figure to quote for a crawler.

### Fixed

- Framing in JSON-LD 1.1 mode dropped a property whose only value was a node reduced
  to a pruned blank node identifier (W3C test `frame#tp046`): the empty node object is
  now kept, as `{}`.
- Microdata: a top-level item (an `itemscope` without `itemprop`) placed inside another
  item's element was dropped, as was the `content` attribute of any element but `<meta>`
  (`<link itemprop="name" content="...">`, which has no `href`). Both are common on real
  pages, and Google reads them.
- The W3C manifest entries that reuse the input of another entry with a different
  expected output (`compact#ta038`, `frame#tp020`, `#tp021`, `#tp046` and `#tp049`)
  are now run. Every test that applies to a JSON-LD 1.1 processor passes.
- Google validator: the address sub-properties of an event location (`streetAddress`,
  `addressRegion`...) are no longer reported when missing: the documentation only shows
  them in an example, and Google does not report them.
- Google validator: the schema.org subtypes of a documented type are now validated with
  its rules, as Google does (a `BusinessEvent` is an `Event`, a `Restaurant` a
  `LocalBusiness`, a `TechArticle` an `Article`). The rule files can refuse subtypes
  (`ItemList`) or exclude some of them (`Event` excludes `CourseInstance`,
  `PublicationEvent`...).
- Google validator: an entity nested under a property its parent does not document (an
  event in the `about` of an article, a video in a course) was never validated. It is now
  validated as a rich result of its own, as Google reports it, when its type is one Google
  documents on its own; the types Google only documents as parts of another one
  (`Comment`, `Answer`, `AggregateRating`, `ImageObject`...) are left alone.

## [0.2.0] - 2026-11-12

### Changed

- Schema.org vocabulary upgraded from 30.0 to 30.1. This release promotes most of the
  pending.schema.org terms to the core vocabulary (`jobTitle`, `Legislation`, `DefinedTerm`,
  `MemberProgram`...): they are no longer reported as pending vocabulary usage.
- Google validator: `VideoObject` now recommends a `creator` (or `author`), which must have a
  `name` or an `alternateName`, and accepts the `LikeAction`, `CommentAction` and
  `ShareAction` interaction types, following the Google documentation.
- The FAQ rich result is marked as retired by Google. `FAQPage` is still validated, for
  backward compatibility.
- Google validator: merchant listings now cover every property the Google documentation
  lists. The product-level recommendations (`category`, `gtin`, `sku`, `size`, `color`,
  `hasCertification`...), the offer-level ones (`itemCondition`, `priceValidUntil`, `url`,
  `validFrom`, `validThrough`) and the nested shipping, return, unit pricing, size, audience,
  certification and 3D model structures are checked. An offer `price` requires a
  `priceCurrency`, a finite return window requires `merchantReturnDays`, and return shipping
  fees require `returnShippingFeesAmount`.
- Google validator: every structured data type is aligned with the current Google
  documentation. A recommended property is reported when missing, unless Google makes it
  conditional ("if applicable", "only recommended for..."): such a property is still checked
  when present, and enforced by a special rule when the document tells whether it applies.
  Notable changes: new recommendations (job posting experience, local business department,
  member program and tier URLs, product snippet notes and aggregate offers, recipe and step
  videos, vacation rental details), new nested structures (organization return and shipping
  policies, video key moments and live badge, beta carousel items, recipe sections), and
  requirements relaxed where Google relaxed them (course `provider`, event `description` and
  `image`, recipe ingredients and instructions). Most organization, profile page, discussion
  forum and Q&A recommendations are conditional and no longer reported when missing.

### Fixed

- The static schema.org context is now generated from the context schema.org publishes with
  each release, instead of being rebuilt from the vocabulary definition file. Documents
  expand as with `"@context": "https://schema.org"`: `schema:` compact IRIs expand to
  `http://schema.org/` (they expanded to `https://schema.org/`), and the definition file's
  own prefixes can no longer shadow a schema.org term (such as `geo` since 30.1).
- Google validator: a property accepting either a data type or a structured type (such as
  "Text or CategoryCode") now validates the nested properties of an object value. The
  `ImageObject` of an article image, the `HowToStep` of recipe instructions and an object
  breadcrumb `item` were never checked so far.
- JSON-LD script tags whose `type` attribute has no quotes (valid HTML, and what minifiers
  produce) or has whitespace around the `=` are no longer ignored.
- A `data-type="application/ld+json"` attribute no longer makes a script tag count as JSON-LD.

## [0.1.0] - 2026-08-17

### Added

- Schema.org validator, covering the schema.org vocabulary (version exposed at runtime as
  `SchemaOrgValidator::VOCABULARY_VERSION`).
- Google validator, reporting whether a document is eligible for Google Rich Results.
- Extraction of JSON-LD, microdata and RDFa structured data from HTML documents.
- The four W3C JSON-LD 1.1 algorithms: expansion, compaction, flattening and framing, each
  validated against the official W3C test suites.
- Deny-by-default remote `@context` loading through `DocumentLoaderInterface`,
  `HttpDocumentLoader` and `RemoteContextPolicy`. No outbound request is made unless the
  application opts in and allow-lists hosts explicitly.
- Command-line interface (via [Castor](https://github.com/jolicode/castor/)) to validate
  documents and run the algorithms.

### Security

- Hostile documents can no longer crash the process: input nested more deeply than a fixed
  limit is refused before the parsed structure graph is built, and a top-level scalar
  document is reported invalid instead of raising an uncaught error.
- Remote-context loading enforces the policy on every redirect hop (not only on the final
  URL), refuses URLs carrying userinfo or a non-default port, and streams responses under a
  hard size cap.
