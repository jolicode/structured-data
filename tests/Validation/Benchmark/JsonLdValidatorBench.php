<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation\Benchmark;

use Jolicode\JsonLd\Validator;

class JsonLdValidatorBench
{
    private const FIXTURES_BASE_DIR = __DIR__ . '/../fixtures';

    /** @var array<string, string> */
    private array $documents = [];

    public function __construct(
        private readonly Validator $validator = new Validator(),
    ) {
        // Fixtures are read once, outside of the measured code paths: the validator
        // only ever receives document contents.
        foreach ([
            '/schema-org/simple-expanded.jsonld',
            '/schema-org/complex-expanded.jsonld',
            '/google/book.jsonld',
            '/benchmark/homepage-sample.html',
            '/benchmark/listing-sample.html',
            '/benchmark/jolicampus-formations-symfony.html',
        ] as $fixture) {
            $content = file_get_contents(self::FIXTURES_BASE_DIR . $fixture);

            if (false === $content) {
                throw new \RuntimeException(\sprintf('The fixture "%s" could not be read.', $fixture));
            }

            $this->documents[$fixture] = $content;
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
    public function benchHtmlSampleHomepagePage(): void
    {
        $this->validator->audit($this->documents['/benchmark/homepage-sample.html']);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlSampleListingPage(): void
    {
        $this->validator->audit($this->documents['/benchmark/listing-sample.html']);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlJolicampusSymfonyPage(): void
    {
        $this->validator->audit($this->documents['/benchmark/jolicampus-formations-symfony.html']);
    }
}
