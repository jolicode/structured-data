<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace website;

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\finder;
use function Castor\fs;
use function Castor\io;
use function Castor\run;
use function PhpWasm\build as build_wasm;
use function PhpWasm\check_stack;

use PhpWasm\Stack;
use PhpWasm\Target;

use function PhpWasm\test_page;

use Symfony\Component\Console\Input\InputOption;

// The demo website: a static page, in website/public, that audits a document
// with the validator, run by PHP built as WebAssembly. See website/README.md.

#[AsTask(description: 'Installs the dependencies of the demo website')]
function install(): void
{
    io()->title('Installing the dependencies of the website');

    $context = context()->withWorkingDirectory(websiteDir());

    run(['composer', 'install', '--no-dev', '--no-progress'], context: $context);
    // The library is a copy of this repository, that Composer only makes again
    // when the commit changes: the website would miss what is not committed.
    run(['composer', 'reinstall', '--no-progress', 'jolicode/structured-data'], context: $context);
    run(['npm', 'ci', '--no-audit', '--no-fund'], context: $context);
}

/**
 * @param list<string> $set
 */
#[AsTask(description: 'Builds the demo website, in website/public/build: its assets, and PHP as WebAssembly with the validator')]
function build(
    #[AsOption(description: 'Overrides a value of the bake file, as "docker buildx bake --set" does (the CI gives the cache this way), can be repeated', mode: InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY)]
    array $set = [],
): void {
    // What is built comes from vendor/ and node_modules/
    install();

    io()->title('Building the website');

    $website = websiteDir();
    $app = "{$website}/build/app";

    fs()->remove([$app, "{$website}/public/build"]);

    run(['npm', 'run', 'build'], context: context()->withWorkingDirectory($website));

    // What is embedded takes some of the memory of the WebAssembly module:
    // only what bin/audit.php reads
    fs()->mirror($website, $app, finder()
        ->in(["{$website}/assets/images", "{$website}/bin", "{$website}/src", "{$website}/templates", "{$website}/vendor"])
        // Composer copies the directories of the repository that Git ignores too
        ->notPath(['jolicode/structured-data/vendor', 'jolicode/structured-data/website'])
        ->notName(['*.md', 'composer.lock']),
    );

    build_wasm([wasmStack()], $set);
}

#[AsTask(description: 'Checks, in node, that what is built for the demo website boots, and audits a document')]
function check(): void
{
    buildIfNeeded();

    io()->title('Checking the website');

    check_stack(wasmStack());
    test_page('website/tests/page.test.mjs', 'website/tests/format.test.mjs');
}

#[AsTask(description: 'Serves the demo website')]
function serve(string $address = 'localhost:9999'): void
{
    buildIfNeeded();

    io()->note("Serving on http://{$address}");

    run(['php', '-S', $address, '-t', websiteDir() . '/public']);
}

function websiteDir(): string
{
    return \dirname(__DIR__) . '/website';
}

/**
 * For the tasks that need what is built: build() when it is missing.
 */
function buildIfNeeded(): void
{
    if (!is_file(wasmStack()->artifact(Target::Web, 'wasm'))) {
        build();
    }
}

/**
 * The PHP that runs the validator in the browser, see https://github.com/lyrixx/php-wasm-builder.
 */
function wasmStack(): Stack
{
    return Stack::named('website')
        ->php('8.5.12')
        // What the library, Twig and league/commonmark require
        ->extensions('ctype', 'dom', 'filter', 'libxml', 'mbstring')
        // Filled by build(), assets/php.js runs /app/bin/audit.php
        ->embed('website/build/app', at: '/app')
        ->targets(Target::Web)
        ->outputDir('website/public/build')
    ;
}
