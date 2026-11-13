# Demo website

A static page that audits a document with the validator, in the browser: PHP is built as
WebAssembly, with [lyrixx/php-wasm-builder](https://github.com/lyrixx/php-wasm-builder), and the
library of this repository embedded in it. GitHub Pages serves `public/`, deployed from `main` by
`.github/workflows/website.yml`.

It comes from
[jolicode/structured-data-validator-demo](https://github.com/jolicode/structured-data-validator-demo),
without its server: the editor and the tree of the properties are its ones, with another look.
Fetching a URL needs a server, and is not here: a page can not read another website. Pretty-printing
the document is the "Format" button of the result: `assets/format.js` runs Prettier in the browser,
as its `bin/format-document.js` does in node.

## How it works

- `public/index.html` is the homepage. `assets/app.js` gives the document of its form, or one of
  `assets/examples.js`, to PHP, and shows what it answers in place of the form.
- `bin/audit.php` is what PHP runs: it audits the document, and renders `templates/result.html.twig`,
  the editor and the result, with Twig.
- `assets/php.js` loads PHP, and runs `bin/audit.php`.

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
