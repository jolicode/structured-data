---
name: Bug report
about: A validation result or algorithm output that looks wrong
title: ""
labels: bug
assignees: ""
---

## Description

<!-- What did you expect to happen, and what happened instead? -->

## Input document

<!-- The SMALLEST document that reproduces the problem. Paste the raw JSON-LD,
     microdata or RDFa / HTML — not a screenshot, not a URL. -->

```
paste your document here
```

## Code

```php
$validator = new \JoliCode\StructuredData\Validator();
$audit = $validator->audit($document);
// ...
```

## Expected diagnostic / output

<!-- What the validator or algorithm should have returned. -->

## Actual diagnostic / output

<!-- What it actually returned (copy the messages or the output verbatim). -->

## Environment

- Library version / commit:
- PHP version:
