# Demo website

> [!TIP]
> This demo website is deployed under https://structured-data-validator.jolicode.com/

Static pages, that run the library in the browser: PHP is built as WebAssembly, with
[lyrixx/php-wasm-builder](https://github.com/lyrixx/php-wasm-builder), and the library of this
repository embedded in it. GitHub Pages serves `public/`, deployed from `main` by
`.github/workflows/website.yml`.

- The **homepage**, at `/`, has the form of the validator, and its examples.
- The **validator**, at `/validator/`, audits a document, and shows the result.
- The **JSON-LD playground**, at `/playground/`, runs the JSON-LD algorithms on a document: expand,
  compact, flatten, frame, to RDF and from RDF.

The validator comes from
[jolicode/structured-data-validator-demo](https://github.com/jolicode/structured-data-validator-demo),
without its server: the editor and the tree of the properties are its ones, with another look.
Fetching a URL needs a server, and is not here: a page can not read another website. Pretty-printing
the document is the "Format" button of the result: `assets/format.js` runs Prettier in the browser,
as its `bin/format-document.js` does in node.

## How it works

`assets/php.js` loads PHP, and runs a script of `bin/`: the request is on its standard input, and its
answer on its standard output, as JSON.

### The state of the pages

The validator and the playground share a state: the document, and what the playground adds to it
(its tab, its context, its frame, its options). `assets/pageState.js` writes it:

- in the fragment of the URL of the page, compressed by `assets/permalink.js`: a link to the page
  opens it as it is, and its "Copy link" button copies this link;
- in the links of the menu: the validator opens the playground with its document, and the
  playground the validator, that validates what was typed there.

A state too long for a link is kept in the session storage of the tab, and the fragment is `#local`:
the pages still open each other, and reload, but "Copy link" is disabled.

### The validator

- `public/index.html` is the homepage. `assets/home.js` opens the page of the validator with the
  document of its form, or one of `assets/examples.js`. Nothing is audited there: PHP is only
  fetched ahead.
- `public/validator/index.html` is the page of the validator. It holds the frame of the result, the
  editor and the toolbar, that shows as the page opens: PHP has to start before it answers, and the
  document is there meanwhile. `assets/controllers/result_controller.js` runs the page: it gives
  the document the page is opened with to PHP, and shows what it answers in this frame. Without a
  document, it goes back to the homepage. The document is audited again as it is typed, once the
  visitor pauses, as in the playground: PHP runs in the thread of the page, so a document that
  takes long to audit waits for a longer pause.
- `bin/audit.php` is what PHP runs: it audits the document, and renders what is found with Twig,
  the counts of the toolbar, `templates/counts.html.twig`, and the entities,
  `templates/result.html.twig`. The settings of the audit are the ones of who opens the page: they
  are not in the link.

### The playground

- `public/playground/index.html` is the page, and `assets/controllers/playground_controller.js` what
  runs it: the algorithm of the selected tab runs again as the visitor types, on the document, with
  the context or the frame it needs, and the options it reads.
- `bin/playground.php` is what PHP runs: an algorithm, on what it is given. It answers with the
  output, or the error code of the specification.
- `assets/jsonLd.js` loads the remote contexts. PHP has no network in the browser: when a document
  needs a context that is not there, `bin/playground.php` answers that it is missing,
  `assets/loadUrl.js` fetches it, and PHP is asked again with it. The website of the context has to
  allow it, with CORS headers. The schema.org context is the one the library ships, and is never
  fetched.
- `assets/playgroundExamples.js` holds the examples.

Canonicalization (RDFC-1.0) is not there: the library does not implement it.

### Every page

- `assets/editor.js` is the CodeMirror editor of the validator and of the playground.
- The header, with its menu, is written in each page: there is no layout to share it. The links are
  relative: the website works under any path.
- The footer is the JoliCode open-source one, [jolicode/oss-theme](https://github.com/jolicode/oss-theme):
  `castor website:build` downloads it to `public/build/joli-footer.html`, and the homepage and the
  playground load it.

## Build it

Docker, node and [Castor](https://github.com/jolicode/castor) are needed. The tasks are in
`.castor/website.php`:

Command | Description
---- | -----
`castor website:build` | Installs the dependencies, and builds the assets and PHP in `public/build/`
`castor website:check` | Checks, in node, that PHP boots, and runs the tests of `tests/`
`castor website:serve` | Serves the website on http://localhost:9999

`composer.json` declares the parent directory as a path repository: the website is built with the
code of the working directory, not with a release. Run `castor website:build` again after a change:
only the last step of the build of PHP runs again.

A test file of `tests/` runs once it is listed in the `check()` task.
