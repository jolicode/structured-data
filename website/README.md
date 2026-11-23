# Demo website

> [!TIP]
> This demo website is deployed under https://structured-data-validator.jolicode.com/

Static pages that run the library in the browser: PHP is built as WebAssembly, with
[lyrixx/php-wasm-builder](https://github.com/lyrixx/php-wasm-builder), and the library of this
repository is embedded in it. GitHub Pages serves `public/`, deployed from `main` by
`.github/workflows/website.yml`.

Page | Path | What it does
---- | ---- | ----
Homepage | `/` | The form of the validator, and its examples
Validator | `/validator/` | Audits a document, and shows the result
JSON-LD playground | `/playground/` | Runs the JSON-LD algorithms on a document

## How it works

- `assets/php.js` loads PHP and runs a script of `bin/`, with the request as JSON on its standard
  input and the answer as JSON on its standard output: `bin/audit.php` for the validator,
  `bin/playground.php` for the playground.
- `assets/home.js` runs the homepage, and `assets/controllers/` the two other pages. Both run PHP
  again as the visitor types.
- `assets/pageState.js` keeps the document in the fragment of the URL: a link opens a page as it
  is, and the validator and the playground open each other with the same document. A document too
  long for a link is kept in the session storage instead.
- PHP has no network in the browser: `assets/jsonLd.js` fetches the remote contexts the playground
  needs, from the websites that allow it with CORS headers.

## Loading a page from its URL

A browser can not read a website that does not allow it with CORS headers, and most do not. The
"Load" button of the homepage posts the URL to `/load-url` instead (`loadPage()` in
`assets/loadUrl.js`), where a proxy downloads the page.

This proxy is not in this repository, and only exists on the deployed website. Elsewhere, a local
build or a fork, the browser loads the page itself, which only works for the websites that allow it.

What is pasted never leaves the browser: only the URL of a page to load is sent.

## Build it

Docker, node and [Castor](https://github.com/jolicode/castor) are needed.

Command | Description
---- | -----
`castor website:build` | Installs the dependencies, and builds the assets and PHP in `public/build/`
`castor website:check` | Checks, in node, that PHP boots, and runs the tests of `tests/`
`castor website:serve` | Serves the website on http://localhost:9999

The website is built with the code of the working directory, not with a release: run
`castor website:build` again after a change. A new test file of `tests/` has to be listed in the
`check()` task of `.castor/website.php`.
