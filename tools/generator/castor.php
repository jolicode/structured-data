<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace generator;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\check;
use function Castor\finder;
use function Castor\fs;
use function Castor\http_download;
use function Castor\io;
use function Castor\run;

use Jolicode\JsonLd\Generator\Filesystem;
use Jolicode\JsonLd\Generator\GeneratorsContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Generator;
use Jolicode\SchemaOrg\Mapper\MappedType;
use Jolicode\SchemaOrg\SchemaOrg;
use Jolicode\SchemaOrg\Validator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\ExecutableFinder;

#[AsTask(description: 'Installs generator tooling')]
function install(): void
{
    run(['composer', 'install', '-o', '--working-dir', __DIR__]);
}

#[AsTask(description: 'Updates generator tooling')]
function update(): void
{
    run(['composer', 'update', '-o', '--working-dir', __DIR__]);
}

#[AsTask(description: 'Generate classes for JSON-LD validation')]
function generate(
    #[AsOption(name: 'update', mode: InputOption::VALUE_NONE, description: 'Reset the generated files')]
    bool $update,
): void {
    io()->title('Generating classes for JSON-LD validation');

    if (!file_exists(getCurrentSchemaOrgDefinitionFileName())) {
        io()->info('The schema.org types definition file is missing, downloading it.');
        downloadSchemaOrgTypesFile();
    }

    $generatorsContainer = new GeneratorsContainer();

    foreach ($generatorsContainer->getGenerators() as $generator) {
        io()->info('Generating classes for ' . $generator->getName());
        $generator->generate($update);
    }

    io()->success('Classes generated successfully');
}

#[AsTask(name: 'schema-org:download-definition', description: 'Download the schema.org types definition file')]
function downloadSchemaOrgTypesFile(
    bool $overwrite = false,
): void {
    io()->title('Downloading the schema.org types definition file');
    $filename = getCurrentSchemaOrgDefinitionFileName();

    if (!$overwrite && file_exists($filename)) {
        return;
    }

    http_download(
        \sprintf(
            'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/%s/schemaorg-current-https.jsonld',
            SchemaOrg::VERSION,
        ),
        $filename,
    );
    io()->success('Schema.org types updated successfully');
}

#[AsTask(name: 'schema-org:examples:update', description: 'Updates the schema.org example files stored in the resources directory')]
function downloadSchemaOrgExamples(): void
{
    io()->title('Downloading the schema.org examples file');
    check(
        'Check if Git is installed',
        'Git is not installed. Please install it before.',
        fn () => (new ExecutableFinder())->find('git'),
    );

    fs()->remove(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git clone --filter=blob:none --sparse --depth=1 https://github.com/schemaorg/schemaorg.git ' . Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git sparse-checkout set --no-cone "/data/ext" "/data/examples.txt"', workingDirectory: Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git checkout main', workingDirectory: Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');

    $generator = new Generator();

    foreach (finder()->name('*.txt')->in(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git/data')->files() as $file) {
        $generator->generateExamples($file->getContents());
    }

    fs()->remove(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    io()->success('Schema.org examples file downloaded successfully');
}

#[AsTask(name: 'schema-org:examples:baseline', description: 'Update the schema.org examples baseline file')]
function updateSchemaOrgExamplesBaseline(): void
{
    $finder = finder()->files()->in(Filesystem::SCHEMA_ORG_EXAMPLES_DIR)->name('*.json-ld')->sortByName();
    $validator = new Validator();
    $baseline = [];

    foreach ($finder as $file) {
        $types = $validator->getTypes($file->getContents());
        $errors = array_filter(
            $types,
            fn (MappedType $type) => (bool) $type->errors,
        );

        if (\count($errors) > 0) {
            $errors = array_reduce(
                $errors,
                fn (array $carry, MappedType $type) => array_merge($carry, $type->getErrorMessages()),
                [],
            );
            $baseline[$file->getFilename()] = $errors;
        }
    }

    fs()->dumpFile(
        Filesystem::SCHEMA_ORG_EXAMPLES_DIR . '/../examples-baseline.json',
        json_encode($baseline, \JSON_PRETTY_PRINT),
    );
}

function getCurrentSchemaOrgDefinition(): string
{
    return file_get_contents(getCurrentSchemaOrgDefinitionFileName());
}

function getCurrentSchemaOrgDefinitionFileName(): string
{
    return \sprintf(
        '%s/schemaorg-%s-https.jsonld',
        Filesystem::CACHE_DIR_SCHEMA_ORG,
        SchemaOrg::VERSION,
    );
}
