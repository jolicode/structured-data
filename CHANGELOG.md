# Changelog

## [Unreleased]

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
