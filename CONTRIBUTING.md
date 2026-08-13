# Contributing

First of all, **thank you** for contributing, **you are awesome**!

Everybody should be able to help. Here's how you can do it:

1. [Fork it](https://github.com/jolicode/structured-data/fork)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Here's some tips to make you the best contributor ever:

* [Rules](#rules)
* [Green tests](#green-tests)
* [Standard code](#standard-code)
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

When adding or updating validator support (new types, schema versions, special validation rules):

- **Google validator** updates are based on the [Google structured-data documentation](https://developers.google.com/search/docs/advanced/structured-data/intro-structured-data). For special rules or complex validation logic, see the existing rule implementations in `src/Vocabularies/Validators/Google/SpecialRules/`.
- **Schema.org validator** updates follow [official schema.org releases](https://schema.org/docs/releases.html).

For comprehensive upgrade procedures for either validator, refer to:
- [Google validator upgrade guidelines](resources/google/UPGRADE_GUIDELINES.md)
- [Schema.org validator upgrade guidelines](resources/schema.org/UPGRADE_GUIDELINES.md)

## Standard code

Use [PHP CS fixer](https://cs.symfony.com/) to make your code compliant with
our coding standards:

```shell
castor qa:cs
```

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
