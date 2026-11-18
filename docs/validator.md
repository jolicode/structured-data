# Validating structured data

To validate a document, use the `JoliCode\StructuredData\Validator` class. It accepts
JSON-LD, microdata and RDFa (schema.org-style RDFa only), either as a JSON-LD document or
embedded in an HTML page.

## Accepted inputs

`audit()` takes **the document itself**, as a string - never a URL, never a file path.

This library deliberately does not guess what a string is, and never fetches anything on
your behalf. Guessing is a security hazard: an application that forwards user input to a
validator would silently offer an attacker a way to reach its internal network
(`http://127.0.0.1:9200/`, cloud metadata endpoints), or to read local files through a
path or a stream wrapper (`/var/www/.env`, `file://`, `phar://`).

Whether a document may be fetched, from where, and under which restrictions is a decision
only your application can make. So your application is the one that fetches:

```php
// From a local file - the path comes from you, not from a user
$document = file_get_contents('/path/to/document.html');

// From the network - your HTTP client, your allow-list, your timeouts
$document = $httpClient->request('GET', $trustedUrl)->getContent();

$audit = $validator->audit($document);
```

The same rule applies to the `@context` URLs found *inside* a document: see
[Loading remote contexts](remote-contexts.md).

## Reading the result

`audit()` returns a `JoliCode\StructuredData\Audit\Audit` object:

- `isValid()` returns true if no errors are detected;
- `isFullyValid()` returns true if no errors, no warnings, and no malformed (hence
  unusable) data structures were detected;
- `getDiagnostic()` returns the messages (errors and warnings).

**Keep in mind that a schema.org type is considered valid even with warnings!**

```php
use JoliCode\StructuredData\Validator;

$validator = new Validator();
$audit = $validator->audit($document);

if (!$audit->isValid()) {
    foreach ($audit->getDiagnostic() as $message) {
        // [Google warning] DataFeed.dataFeedElement.workExample: Missing recommended property: "sameAs" for the type "Book"
        // [Google error] DataFeed.dataFeedElement.workExample.potentialAction.expectsAcceptanceOf: Missing required property: "price" for the type "Offer" when "category" is "purchase" or "rental".
        echo $message;
    }
}
```

`getDiagnostic()` accepts an optional `JoliCode\StructuredData\Audit\AuditOptions` object,
which lets you filter or group the results, or change the return format. See its PHPDoc
for details.

To access the full parsed PHP tree, use `getTypes()` and inspect the underlying
`MappedType` objects directly. These are low-level objects, but they are the most detailed
information you can get, and they preserve the type hierarchy of the document. For an idea
of what you can do with them, look at the output of the `castor validate` command.

## Running a single validator

If you are only interested in the results of a single validator, call `setValidator()`
before auditing:

```php
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;

$validator = new Validator();
$validator->setValidator(GoogleValidator::class);

$validator->audit($document);
```

## Pending vocabulary

Terms hosted under [pending.schema.org](https://pending.schema.org) are still under
development and may change or be removed. Using them is legitimate, so the validator
accepts them silently by default; opt in to `$reportPendingVocabularyUsage` to get a
warning for each of these usages instead:

```php
$audit = $validator->audit($document, reportPendingVocabularyUsage: true);
```

## Blocks describing the same node

Google reads a page as one graph: the blocks that share an identifier (a JSON-LD `@id`,
a microdata `itemid`) are one node holding the union of their properties, whatever their
format, and a property one block omits is not missing when another block provides it.

By default, the validator does the same. The audit is made of items, one per node, listed
by `Audit::getItems()`: the blocks sharing an identifier make one item, the others one
item each. The diagnostics of the audit (`isValid()`, `getDiagnostic()`) are the ones of
the items, so an issue of a merged node is reported once, with the positions of every
block it comes from.

```php
foreach ($audit->getItems() as $item) {
    $item->getType();       // the node: merged from several blocks, or the block itself
    $item->isMerged();      // true when the node comes from several blocks
    $item->getIdentifier(); // its absolute "@id" or "itemid", if any
    $item->getSources();    // the blocks it comes from
}
```

Each source block keeps its own audit, as if it were alone in the document: a block may
report a property another block provides, while the merged item, which makes the verdict,
does not. `Audit::getTypes()` still lists the blocks.

When the blocks disagree on a value, Google keeps every value and reports nothing; the
validator raises a warning on the property of the merged node, with the `Merge` validator
name (`AuditOptions::VALIDATOR_MERGE`), outside the Google diagnostics. Blank node
identifiers are local to their block and never merge, and identifiers are compared as
written. Only the top-level node of each block is merged: nested nodes sharing an
identifier are not.

Google is not the only consumer of structured data, though. To audit every block on its
own, with no merge, disable the option:

```php
$audit = $validator->audit($document, mergeNodesSharingAnIdentifier: false);
```

Each block is then an item of its own.

## Command line interface

From a clone of this repository, with [Castor](https://github.com/jolicode/castor/)
installed, two commands validate a document from the command line or in CI. `castor check`
gives a short verdict, `castor validate` a parsed and colored full audit (it can be pretty
verbose!). Both return a meaningful exit code.

```bash
castor check <file-or-url>
castor validate <file-or-url>
castor validate <file-or-url> google      # a single validator: google or schema-org
castor validate --no-merge <file-or-url>  # audit every block on its own
```

Unlike the `Validator::audit()` API, these commands **do** accept a file path or a URL,
and will read or fetch it for you. That is safe here precisely because the argument comes
from the operator running the command, not from a document being processed - exactly the
distinction drawn in [Accepted inputs](#accepted-inputs).

<img width="822" height="749" alt="Output of the castor validate command" src="https://github.com/user-attachments/assets/97912eb8-1e11-4ba9-8cc1-ac0b6248d816" />
