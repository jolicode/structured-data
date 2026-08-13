<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace schema_org;

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\check;
use function Castor\context;
use function Castor\finder;
use function Castor\fs;
use function Castor\http_download;
use function Castor\http_request;
use function Castor\io;
use function Castor\run;

use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Filesystem;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Generator;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\SchemaOrg;

use function qa\fixGeneratedFilesFormatting;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

// The releases are published as one directory per version in the schema.org
// repository, and only mirrored on https://schema.org/docs/releases.html later on.
const RELEASES_API_URL = 'https://api.github.com/repos/schemaorg/schemaorg/contents/data/releases';

/**
 * The two constants that must always describe the same vocabulary release: the one
 * driving the generation, and the one the validator reports at runtime.
 *
 * @return array<string, string> the file holding the constant, and the constant name
 */
function versionedFiles(): array
{
    return [
        \dirname(__DIR__) . '/generators/SchemaOrg/SchemaOrg.php' => 'VERSION',
        \dirname(__DIR__) . '/src/Vocabularies/Validators/SchemaOrg/SchemaOrgValidator.php' => 'VOCABULARY_VERSION',
    ];
}

#[AsTask(description: 'Download the schema.org types definition file')]
function download(
    bool $overwrite = false,
): void {
    io()->title('Downloading the schema.org types definition file');
    $filename = getCurrentSchemaOrgDefinitionFileName();

    if (!$overwrite && file_exists($filename)) {
        io()->warning("
            The definition file already exists. Skipping.\n
            Run `castor schema-org:download --overwrite` if you want to overwrite it.
        ");

        return;
    }

    http_download(getDefinitionFileUrl(SchemaOrg::VERSION), $filename);

    io()->success('Schema.org types definition file downloaded successfully');
}

#[AsTask(description: 'Generate classes for JSON-LD validation based on the schema.org types definition file')]
function generate(): void
{
    io()->title('Generating schema.org classes');

    if (!file_exists(getCurrentSchemaOrgDefinitionFileName())) {
        io()->info('The schema.org types definition file is missing, downloading it.');
        download();
    }

    $generator = new Generator();

    $generator->generate();
    fixGeneratedFilesFormatting('SchemaOrg');

    io()->success('Schema.org classes successfully generated.');
}

#[AsTask(name: 'download-examples', description: 'Updates the schema.org example files stored in the resources directory')]
function downloadExamples(): void
{
    io()->title('Downloading the schema.org examples file');
    check(
        'Check if Git is installed',
        'Git is not installed. Please install it before.',
        static fn (): bool => null !== (new ExecutableFinder())->find('git'),
    );

    fs()->remove(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git clone --filter=blob:none --sparse --depth=1 https://github.com/schemaorg/schemaorg.git ' . Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');

    $context = context()->withWorkingDirectory(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    run('git sparse-checkout set --no-cone "/data/ext" "/data/examples.txt"', $context);
    run('git checkout main', $context);

    $generator = new Generator();

    foreach (finder()->name('*.txt')->in(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git/data')->files() as $file) {
        $generator->generateExamples($file->getContents());
    }

    fs()->remove(Filesystem::CACHE_DIR_SCHEMA_ORG . '/git');
    io()->success('Schema.org examples file downloaded successfully');
}

#[AsTask(name: 'update-version', description: 'Bump the schema.org vocabulary version to the latest release published on GitHub')]
function updateVersion(
    #[AsOption(name: 'dry-run', mode: InputOption::VALUE_NONE, description: 'Only report the release that would be used, without writing anything')]
    ?bool $dryRun = null,
): int {
    io()->title('Looking for the latest schema.org release');

    try {
        $releases = fetchPublishedReleases();
    } catch (ExceptionInterface $exception) {
        io()->error(\sprintf('Could not list the schema.org releases: %s', $exception->getMessage()));

        return 1;
    }

    if ([] === $releases) {
        io()->error(\sprintf('No release directory was found in %s.', RELEASES_API_URL));

        return 1;
    }

    // A version may be announced while its definition file is not published yet: the
    // latest usable release is the latest one we can actually download.
    $latest = null;

    foreach ($releases as $release) {
        if (definitionFileIsPublished($release)) {
            $latest = $release;

            break;
        }

        io()->warning(\sprintf('Release %s is listed but its definition file is not published yet, skipping it.', $release));
    }

    if (null === $latest) {
        io()->error('None of the listed releases has a downloadable definition file.');

        return 1;
    }

    $current = SchemaOrg::VERSION;

    if ($latest === $current) {
        io()->success(\sprintf('The vocabulary is already up to date (schema.org %s).', $current));

        return 0;
    }

    if (version_compare($latest, $current, '<')) {
        io()->warning(\sprintf(
            'The latest published release (%s) is older than the configured one (%s). Nothing was changed.',
            $latest,
            $current,
        ));

        return 0;
    }

    if ($dryRun) {
        io()->info(\sprintf('Schema.org %s is available (currently using %s). Nothing was written.', $latest, $current));

        return 0;
    }

    foreach (versionedFiles() as $file => $constant) {
        replaceVersionConstant($file, $constant, $latest);
    }

    io()->success(\sprintf('Schema.org version bumped from %s to %s.', $current, $latest));
    io()->writeln('Next steps:');
    io()->listing([
        'castor schema-org:download',
        'castor schema-org:generate',
        'castor schema-org:download-examples',
        'castor qa:phpunit:run -g schema-org',
    ]);
    io()->info('The full procedure is described in resources/schema.org/UPGRADE_GUIDELINES.md.');

    return 0;
}

/**
 * The published releases, from the most recent to the oldest.
 *
 * @throws ExceptionInterface when the GitHub API cannot be reached
 *
 * @return list<string>
 */
function fetchPublishedReleases(): array
{
    $response = http_request('GET', RELEASES_API_URL, ['headers' => githubApiHeaders()]);
    $versions = [];

    /** @var array<array{name?: string, type?: string}> $entries */
    $entries = $response->toArray();

    foreach ($entries as $entry) {
        $name = $entry['name'] ?? '';

        if ('dir' === ($entry['type'] ?? '') && preg_match('/^\d+(\.\d+)+$/', $name)) {
            $versions[] = $name;
        }
    }

    usort($versions, static fn (string $left, string $right): int => version_compare($right, $left));

    return $versions;
}

/**
 * Whether the definition file of a release can actually be downloaded: schema.org
 * sometimes lists a release before publishing its data files.
 */
function definitionFileIsPublished(string $version): bool
{
    try {
        return 200 === http_request('HEAD', getDefinitionFileUrl($version))->getStatusCode();
    } catch (ExceptionInterface) {
        return false;
    }
}

/**
 * @return array<string, string>
 */
function githubApiHeaders(): array
{
    $headers = [
        'Accept' => 'application/vnd.github+json',
        'X-GitHub-Api-Version' => '2022-11-28',
    ];

    // Unauthenticated calls are rate-limited to 60 requests per hour and per IP.
    $token = getenv('GITHUB_TOKEN');

    if (\is_string($token) && '' !== $token) {
        $headers['Authorization'] = 'Bearer ' . $token;
    }

    return $headers;
}

function replaceVersionConstant(string $file, string $constant, string $version): void
{
    $content = file_get_contents($file);

    if (false === $content) {
        throw new \RuntimeException(\sprintf('The file "%s" could not be read.', $file));
    }

    $updated = preg_replace(
        \sprintf("/(public const %s = ')[^']+(';)/", preg_quote($constant, '/')),
        '${1}' . $version . '${2}',
        $content,
        1,
        $count,
    );

    if (null === $updated || 1 !== $count) {
        throw new \RuntimeException(\sprintf('Could not find the "%s" constant declaration in "%s".', $constant, $file));
    }

    fs()->dumpFile($file, $updated);
    io()->writeln(\sprintf('Updated %s in %s.', $constant, $file));
}

function getDefinitionFileUrl(string $version): string
{
    return \sprintf(
        'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/%s/schemaorg-current-https.jsonld',
        $version,
    );
}

function getCurrentSchemaOrgDefinitionFileName(): string
{
    return \sprintf(
        '%s/schemaorg-%s-https.jsonld',
        Filesystem::CACHE_DIR_SCHEMA_ORG,
        SchemaOrg::VERSION,
    );
}
