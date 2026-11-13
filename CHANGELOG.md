# Changelog

## [Unreleased]

### Added

- `castor qa:earl` runs the W3C test suites and writes the EARL conformance report
  consolidated by the W3C JSON-LD implementation report. The W3C manifests are now kept
  with the downloaded test suites.
- `BENCHMARKS.md` documents the benchmark figures and what each of them measures.
  `castor qa:bench:validators` now also runs the worker benchmark, which audits a stream
  of distinct documents and is the figure to quote for a crawler.

### Fixed

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
- Microdata: a top-level item (an `itemscope` without `itemprop`) placed inside another
  item's element was dropped, as was the `content` attribute of any element but `<meta>`
  (`<link itemprop="name" content="...">`, which has no `href`). Both are common on real
  pages, and Google reads them.
- Framing in JSON-LD 1.1 mode dropped a property whose only value was a node reduced
  to a pruned blank node identifier (W3C test `frame#tp046`): the empty node object is
  now kept, as `{}`.
- The W3C manifest entries that reuse the input of another entry with a different
  expected output (`compact#ta038`, `frame#tp020`, `#tp021`, `#tp046` and `#tp049`)
  are now run. Every test that applies to a JSON-LD 1.1 processor passes.

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
