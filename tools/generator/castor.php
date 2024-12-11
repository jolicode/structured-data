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

use function Castor\io;
use function Castor\run;

use Jolicode\JsonLd\Generator\Downloader;
use Jolicode\JsonLd\Generator\Filesystem;
use Jolicode\JsonLd\Generator\GeneratorsContainer;
use Symfony\Component\Console\Input\InputOption;

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

    if (!(new Filesystem())->hasSchemaOrgTypesDefinitionFile()) {
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

    $downloader = new Downloader();
    $downloader->downloadSchemaOrgTypesDefinitionFile($overwrite);

    io()->success('Schema.org types updated successfully');
}

#[AsTask(name: 'schema-org:update-examples', description: 'Updates the schema.org example files stored in the resources directory')]
function downloadSchemaOrgExamples(): void
{
    io()->title('Downloading the schema.org examples file');

    $downloader = new Downloader();
    $downloader->downloadSchemaOrgExamples();

    io()->success('Schema.org examples file downloaded successfully');
}
