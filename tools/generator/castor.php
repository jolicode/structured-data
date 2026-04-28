<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace generation;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use Castor\Attribute\AsArgument;
use Castor\Attribute\AsTask;

use function Castor\check;
use function Castor\context;
use function Castor\finder;
use function Castor\fs;
use function Castor\http_download;
use function Castor\io;
use function Castor\run;

use Jolicode\JsonLd\Generator\Google\Filesystem as GoogleFilesystem;
use Jolicode\JsonLd\Generator\Google\Generator as GoogleGenerator;
use Jolicode\JsonLd\Generator\SchemaOrg\Filesystem as SchemaOrgFilesystem;
use Jolicode\JsonLd\Generator\SchemaOrg\Generator as SchemaOrgGenerator;
use Jolicode\JsonLd\Generator\SchemaOrg\SchemaOrg;
use Symfony\Component\Process\ExecutableFinder;

#[AsTask(aliases: ['generate'], description: 'Generate validation classes for all supported vocabularies. Will use the currently downloaded data.')]
function generate(
    #[AsArgument(name: 'specific-generator', description: 'to only generate classes for a specific generator. Accepted values are: "schemaorg", "google".')]
    ?string $specific = null,
): void {
    if ($specific) {
        $specific = strtolower($specific);

        if (!\in_array($specific, ['schemaorg', 'google'], true)) {
            io()->error('Invalid generator specified. Accepted values are: "schemaorg", "google".');

            return;
        }

        if ('schemaorg' === $specific) {
            generateSchemaOrg();
            warnAboutGeneratedFilesFormatting('SchemaOrg');

            return;
        }

        generateGoogle();
        warnAboutGeneratedFilesFormatting('Google');

        return;
    }

    io()->title('Generating classes for all supported vocabularies.');

    generateSchemaOrg();
    generateGoogle();
    warnAboutGeneratedFilesFormatting();

    io()->success('Classes generated successfully');
}

#[AsTask(namespace: 'google:generation', description: 'Extract requirements from the Google documentation and generate the validation classes')]
function generateGoogle(): void
{
    $generator = new GoogleGenerator();
    io()->title('Generating Google classes');

    $generator->generate(io());
    io()->success('Google classes successfully generated.');
}

#[AsTask(namespace: 'schema-org:generation', description: 'Generate classes for JSON-LD validation based on the schema.org types definition file')]
function generateSchemaOrg(): void
{
    io()->title('Generating schema.org classes');

    if (!file_exists(getCurrentSchemaOrgDefinitionFileName())) {
        io()->info('The schema.org types definition file is missing, downloading it.');
        downloadSchemaOrgTypesFile();
    }

    $generator = new SchemaOrgGenerator();

    $generator->generate();

    io()->success('Schema.org classes successfully generated.');
}

/**
 * Generated files are committed CS-fixed in this repository, but generation itself
 * does not run PHP-CS-Fixer to avoid slowing down commands/CI.
 */
function warnAboutGeneratedFilesFormatting(?string $vocabulary = null): void
{
    io()->warning('Generated files will differ from committed CS-fixed files after generation.');

    if ('SchemaOrg' === $vocabulary) {
        io()->writeln('If needed, discard generated changes with: git restore --worktree -- src/Vocabularies/Generated/SchemaOrg');

        return;
    }

    if ('Google' === $vocabulary) {
        io()->writeln('If needed, discard generated changes with: git restore --worktree -- src/Vocabularies/Generated/Google');

        return;
    }

    io()->writeln('If needed, discard generated changes with: git restore --worktree -- src/Vocabularies/Generated');
}

#[AsTask(namespace: 'google:generation', description: 'Crawl the Google documentation. Updates resources/google/google-types.json (curated manifest), then downloads HTML for active/extra types.')]
function crawleGoogle(): void
{
    $googleFilesystem = new GoogleFilesystem();

    io()->title('Crawling Google documentation');
    $googleFilesystem->crawleGoogleDoc();

    io()->success('Google documentation successfully crawled and HTML files successfully extracted.');
}

#[AsTask(name: 'verify-docs', namespace: 'google:generation', description: 'Compare live Google structured-data docs against resources/google/google-types.json and the current JSON implementations.')]
function verifyGoogleDocs(): int
{
    $googleFilesystem = new GoogleFilesystem();

    io()->title('Verifying Google structured-data documentation coverage');
    $report = $googleFilesystem->verifyGoogleDocCoverage();

    if ([] !== $report['fetch_failures']) {
        io()->section('Fetch failures');

        foreach ($report['fetch_failures'] as $url => $message) {
            io()->warning(\sprintf('%s: %s', $url, $message));
        }
    }

    if ([] !== $report['missing_from_manifest']) {
        io()->section('Docs pages missing from resources/google/google-types.json');

        foreach ($report['missing_from_manifest'] as $url => $metadata) {
            io()->writeln(\sprintf('- [%s] %s', $metadata['classification'], $url));
        }
    }

    if ([] !== $report['missing_implementations']) {
        io()->section('Concrete docs pages missing JSON implementations');

        foreach ($report['missing_implementations'] as $url => $metadata) {
            io()->writeln(\sprintf('- %s', $url));
        }
    }

    if ([] !== $report['stale_manifest_entries']) {
        io()->section('Manifest entries no longer discoverable from live docs');

        foreach ($report['stale_manifest_entries'] as $entry) {
            io()->writeln(\sprintf('- [%s] %s', $entry['status'] ?? 'active', $entry['url']));
        }
    }

    if (
        [] === $report['fetch_failures']
        && [] === $report['missing_from_manifest']
        && [] === $report['missing_implementations']
        && [] === $report['stale_manifest_entries']
    ) {
        io()->success('Google docs, manifest, and implementations are aligned.');

        return 0;
    }

    io()->warning('Google docs verification found gaps.');

    return 1;
}

#[AsTask(name: 'download-definition', namespace: 'schema-org:generation', description: 'Download the schema.org types definition file')]
function downloadSchemaOrgTypesFile(
    bool $overwrite = false,
): void {
    io()->title('Downloading the schema.org types definition file');
    $filename = getCurrentSchemaOrgDefinitionFileName();

    if (!$overwrite && file_exists($filename)) {
        io()->warning("
            The definition file already exists. Skipping.\n
            Run `castor schema-org:generation:download-definition --overwrite` if you want to overwrite it.
        ");

        return;
    }

    http_download(
        \sprintf(
            'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/%s/schemaorg-current-https.jsonld',
            SchemaOrg::VERSION,
        ),
        $filename,
    );
    io()->success('Schema.org types definition file downloaded successfully');
}

#[AsTask(name: 'update-examples', namespace: 'schema-org:generation', description: 'Updates the schema.org example files stored in the resources directory')]
function downloadSchemaOrgExamples(): void
{
    io()->title('Downloading the schema.org examples file');
    check(
        'Check if Git is installed',
        'Git is not installed. Please install it before.',
        static fn () => (new ExecutableFinder())->find('git'),
    );

    fs()->remove(SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git clone --filter=blob:none --sparse --depth=1 https://github.com/schemaorg/schemaorg.git ' . SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG . '/git');

    $context = context()->withWorkingDirectory(SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git sparse-checkout set --no-cone "/data/ext" "/data/examples.txt"', $context);
    run('git checkout main', $context);

    $generator = new SchemaOrgGenerator();

    foreach (finder()->name('*.txt')->in(SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG . '/git/data')->files() as $file) {
        $generator->generateExamples($file->getContents());
    }

    fs()->remove(SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    io()->success('Schema.org examples file downloaded successfully');
}

function getCurrentSchemaOrgDefinitionFileName(): string
{
    return \sprintf(
        '%s/schemaorg-%s-https.jsonld',
        SchemaOrgFilesystem::CACHE_DIR_SCHEMA_ORG,
        SchemaOrg::VERSION,
    );
}
