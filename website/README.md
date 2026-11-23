# Demo website

> [!TIP]
> This demo website is deployed under https://structured-data-validator.jolicode.com/

Two static pages, that run the library in the browser: PHP is built as WebAssembly, with
[lyrixx/php-wasm-builder](https://github.com/lyrixx/php-wasm-builder), and the library of this
repository embedded in it. GitHub Pages serves `public/`, deployed from `main` by
`.github/workflows/website.yml`.

- The **validator**, at `/`, audits a document.
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

### The validator

- `public/index.html` is the homepage. `assets/app.js` gives the document of its form, or one of
  `assets/examples.js`, to PHP, and shows what it answers in place of the form.
- `bin/audit.php` is what PHP runs: it audits the document, and renders `templates/result.html.twig`,
  the editor and the result, with Twig.
- The "Open in playground" button of the result, shown for a JSON-LD document, opens the playground
  with it.

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
- `assets/permalink.js` writes the state of the page (the tab, the documents, the options) in the
  fragment of its URL: the "Copy link" button copies a link that opens the page as it is.
- `assets/playgroundExamples.js` holds the examples.

Canonicalization (RDFC-1.0) is not there: the library does not implement it.

### Both

- `assets/editor.js` is the CodeMirror editor of both pages.
- The menu is written in each page, and in `templates/result.html.twig`: there is no layout to
  share it. The links are relative: the website works under any path.
- The footer is the JoliCode open-source one, [jolicode/oss-theme](https://github.com/jolicode/oss-theme):
  `castor website:build` downloads it to `public/build/joli-footer.html`, and the pages load it.

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
