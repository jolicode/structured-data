# Contributing

First of all, **thank you** for contributing, **you are awesome**!

Everybody should be able to help. Here's how you can do it:

1. [Fork it](https://github.com/jolicode/structured-data/fork)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Here's some tips to make you the best contributor ever:

* [Rules](#rules)
* [Setting up](#setting-up)
* [Green tests](#green-tests)
* [Standard code](#standard-code)
* [Commands reference](#commands-reference)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)

## Rules

Here are a few rules to follow in order to ease code reviews, and discussions
before maintainers accept and merge your work.

* You MUST follow the [PSR-1](https://www.php-fig.org/psr/psr-1/) and
[PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards. In practice, the project
enforces the `@Symfony` rule set through PHP CS Fixer - just run `castor qa:cs` (see
[Standard code](#standard-code)) and it is taken care of for you.
* You MUST run the test suite (see [Green tests](#green-tests)).
* Your code MUST pass the static analysis: `castor qa:phpstan` (PHPStan, level 9). CI fails on
any error.
* You MUST write (or update) unit tests.
* You SHOULD write documentation.

Please, write [commit messages that make
sense](https://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html),
and [rebase your branch](https://git-scm.com/book/en/Git-Branching-Rebasing)
before submitting your Pull Request (see also how to [keep your
fork up-to-date](#keeping-your-fork-up-to-date)).

One may ask you to [squash your
commits](http://gitready.com/advanced/2009/02/10/squashing-commits-with-rebase.html)
too. This is used to "clean" your Pull Request before merging it (we don't want
commits such as `fix tests`, `fix 2`, `fix 3`, etc.).

Also, while creating your Pull Request on GitHub, you MUST write a description
which gives the context and/or explains why you are creating it.

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

## Setting up

The tooling runs with the PHP task runner [Castor](https://github.com/jolicode/castor/).
Downloading the W3C test suites also needs the
[ZipArchive PHP extension](https://www.php.net/manual/en/class.ziparchive.php).

Clone the repository, then install the library's dependencies and the QA tooling:

```shell
composer install   # the library's own dependencies (Composer, not Castor)
castor qa:install  # the QA tooling: php-cs-fixer, phpstan, phpunit, phpbench, infection
```

All the tasks are defined in the `.castor` directory, one file per namespace.

## Green tests

Run the tests using the following command:

```shell
castor qa:phpunit:run
```

Both schema.org and Google validator tests are included. You can run a single group with:

```shell
castor qa:phpunit:run -g schema-org
castor qa:phpunit:run -g google
```

## Working with validators

This project includes two main validators: the schema.org validator and the Google validator.

### Updating validators

The validation classes shipped in `src/Vocabularies/Generated` are generated from the
vocabulary definitions (see [Vocabulary generation](#vocabulary-generation)). When adding or
updating validator support (new types, schema versions, special validation rules):

- **Google validator** updates track the [Google structured-data documentation](https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data), which evolves continuously. For special rules or complex validation logic, see the existing rule implementations in `src/Vocabularies/Validators/Google/SpecialRules/`.
- **Schema.org validator** updates are driven by the [official schema.org releases](https://schema.org/docs/releases.html). When upgrading, always review the release notes and check that the changes to the `schema-org-baseline.json` test fixture reflect real schema.org changes.

For comprehensive upgrade procedures for either validator, refer to:
- [Google validator upgrade guidelines](resources/google/UPGRADE_GUIDELINES.md)
- [Schema.org validator upgrade guidelines](resources/schema.org/UPGRADE_GUIDELINES.md)

## Standard code

Use [PHP CS fixer](https://cs.symfony.com/) to make your code compliant with
our coding standards:

```shell
castor qa:cs
```

## Commands reference

### QA

Command | Description
---- | -----
`castor qa:install` | Installs the QA tooling
`castor qa:update` | Updates the QA tooling
`castor qa:cs` | Fixes coding standards
`castor qa:phpstan` | Runs PHPStan
`castor qa:all` | Runs all QA tasks
`castor qa:earl` | Runs the W3C test suites and writes the EARL conformance report (see [Conformance](docs/json-ld.md#conformance))

### Tests

Command | Description
---- | -----
`castor qa:phpunit:prepare` | Downloads the W3C tests suite
`castor qa:phpunit:run` | Runs PHPUnit
`castor qa:phpunit:coverage` | Runs PHPUnit with code coverage (requires the pcov or xdebug extension)
`castor qa:infection` | Runs Infection mutation testing on the validator and mapper layers (requires the pcov or xdebug extension)

The W3C suites each have their PHPUnit group: `expand`, `compact`, `flatten`, `frame`, `toRdf`, `fromRdf`,
`remote-doc` and `html` (`castor qa:phpunit:run --group toRdf`). The first four list their fixture files and
set the options of each test in PHP; the others are driven by their manifest
(`tests/Algorithms/Manifest/ManifestTestProvider.php`) and run offline: `W3cFixtureServer` stands for
w3c.github.io and serves the downloaded copy, with the headers the manifest asks for.

The W3C test suite is pinned to a known-good upstream commit (see `W3C_TEST_SUITE_REF` in `.castor/qa.php`).
To re-download it, or to test against the upstream main branch:

```shell
castor qa:phpunit:prepare --force
castor qa:phpunit:prepare --force --ref main
```

### Benchmarks

Command | Description
---- | -----
`castor qa:bench:all` | Runs all the benchmarks
`castor qa:bench:algorithms` | Runs the JSON-LD manipulation algorithms benchmark
`castor qa:bench:validators` | Runs the validators benchmark
`castor qa:bench:validators -d` | Runs the detailed and slow validators benchmark

The latest figures, and what each of them measures, are in [BENCHMARKS.md](BENCHMARKS.md).

### Demo website

These commands build the [demo website](website/README.md), that runs the validator in the browser:

Command | Description
---- | -----
`castor website:build` | Builds the demo website: its assets, and PHP as WebAssembly with the validator
`castor website:check` | Checks, in node, that what is built boots, and audits a document
`castor website:serve` | Serves the demo website

### Vocabulary generation

These commands refresh the validation classes shipped in `src/Vocabularies/Generated`:

Command | Description
---- | -----
`castor schema-org:update-version` | Bump the schema.org version to the latest release published on GitHub
`castor schema-org:download` | Download the schema.org types definition file and JSON-LD context
`castor schema-org:generate` | Generate the schema.org validation classes
`castor schema-org:download-examples` | Refresh the schema.org examples used by the tests
`castor google:download` | Crawl the Google structured-data documentation
`castor google:generate` | Generate the Google validation classes
`castor google:check` | Check the Google documentation coverage against the curated manifest

## Keeping your fork up-to-date

To keep your fork up-to-date, you should track the upstream (original) one
using the following command:

```shell
git remote add upstream https://github.com/jolicode/structured-data.git
```

Then get the upstream changes:

```shell
git checkout main
git pull --rebase origin main
git pull --rebase upstream main
git checkout <your-branch>
git rebase main
```

Finally, publish your changes:

```shell
git push -f origin <your-branch>
```

Your pull request will be automatically updated.

Thank you!
