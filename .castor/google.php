<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace google;

use Castor\Attribute\AsTask;

use function Castor\io;

use JoliCode\StructuredData\Vocabularies\Generators\Google\DocumentationCoverageAuditor;
use JoliCode\StructuredData\Vocabularies\Generators\Google\DocumentationCrawler;
use JoliCode\StructuredData\Vocabularies\Generators\Google\Generator;

use function qa\fixGeneratedFilesFormatting;

#[AsTask(description: 'Crawl the Google documentation. Updates resources/google/google-types.json (curated manifest), then downloads HTML for active/extra types.')]
function download(): void
{
    $crawler = new DocumentationCrawler();

    io()->title('Crawling Google documentation');
    $crawler->crawlGoogleDoc();

    io()->success('Google documentation successfully crawled and HTML files successfully extracted.');
}

#[AsTask(description: 'Extract requirements from the Google documentation and generate the validation classes')]
function generate(): void
{
    $generator = new Generator();
    io()->title('Generating Google classes');

    $generator->generate(io());
    fixGeneratedFilesFormatting('Google');

    io()->success('Google classes successfully generated.');
}

#[AsTask(description: 'Compare live Google structured-data docs against resources/google/google-types.json and the current JSON implementations.')]
function check(): int
{
    $auditor = new DocumentationCoverageAuditor();

    io()->title('Verifying Google structured-data documentation coverage');
    $report = $auditor->verifyGoogleDocCoverage();

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

        foreach ($report['stale_manifest_entries'] as $url => $entry) {
            $status = $entry['status'] ?? 'active';

            io()->writeln(\sprintf('- [%s] %s', \is_string($status) ? $status : 'active', $url));
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
