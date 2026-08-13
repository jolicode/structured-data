<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation\Benchmark;

use JoliCode\StructuredData\Validator;

class JsonLdValidatorBench
{
    private const FIXTURES_BASE_DIR = __DIR__ . '/../fixtures';

    // Large, real-world HTML pages downloaded on demand from JoliCode-owned hosts
    // by `castor qa:phpunit:download-fixtures`. They are never committed.
    private const DOWNLOADED_FIXTURES_DIR = __DIR__ . '/../../../var/cache/benchmark-fixtures';

    /** @var array<string, string> */
    private array $documents = [];

    public function __construct(
        private readonly Validator $validator = new Validator(),
    ) {
        // Small committed fixtures, read once outside of the measured code paths.
        foreach ([
            '/schema-org/simple-expanded.jsonld',
            '/schema-org/complex-expanded.jsonld',
            '/google/book.jsonld',
        ] as $fixture) {
            $this->documents[$fixture] = $this->read(self::FIXTURES_BASE_DIR . $fixture);
        }

        // Large downloaded pages.
        foreach ([
            '/jolicode-homepage.html',
            '/jolicampus-homepage.html',
            '/google-structured-data-intro.html',
        ] as $fixture) {
            $this->documents[$fixture] = $this->read(self::DOWNLOADED_FIXTURES_DIR . $fixture);
        }
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchJsonLdSmallFixture(): void
    {
        $this->validator->audit($this->documents['/schema-org/simple-expanded.jsonld']);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchJsonLdMediumFixture(): void
    {
        $this->validator->audit($this->documents['/schema-org/complex-expanded.jsonld']);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchJsonLdHeavyFixture(): void
    {
        $this->validator->audit($this->documents['/google/book.jsonld']);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlJolicodeHomepagePage(): void
    {
        $this->validator->audit($this->documents['/jolicode-homepage.html']);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlJolicampusHomepagePage(): void
    {
        $this->validator->audit($this->documents['/jolicampus-homepage.html']);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlGoogleStructuredDataPage(): void
    {
        $this->validator->audit($this->documents['/google-structured-data-intro.html']);
    }

    private function read(string $path): string
    {
        $content = @file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('The benchmark fixture "%s" could not be read. Run "castor qa:phpunit:download-fixtures" first.', $path));
        }

        return $content;
    }
}
