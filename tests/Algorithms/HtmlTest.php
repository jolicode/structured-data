<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms;

use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\Tests\Algorithms\Manifest\AbstractRemoteDocumentTestCase;
use JoliCode\StructuredData\Tests\Algorithms\Manifest\ManifestTestProvider;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

/**
 * @see https://w3c.github.io/json-ld-api/tests/html-manifest.html
 */
#[Group('html')]
class HtmlTest extends AbstractRemoteDocumentTestCase
{
    /**
     * @param array<string, mixed> $server
     */
    #[DataProvider('provideManifestEntries')]
    public function testHtml(string $algorithm, string $url, ?string $context, ?string $expect, ?string $errorCode, ProcessorOptions $options, array $server): void
    {
        $this->runManifestEntry($algorithm, $url, $context, $expect, $errorCode, $options, $server);
    }

    /**
     * @return iterable<string, array{algorithm: string, url: string, context: string|null, expect: string|null, errorCode: string|null, options: ProcessorOptions, server: array<string, mixed>}>
     */
    public static function provideManifestEntries(): iterable
    {
        return ManifestTestProvider::provideDocuments(Algorithms::HTML_SUITE);
    }
}
