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

    public function __construct(
        private readonly Validator $validator = new Validator(),
    ) {
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/schema-org/simple-expanded.jsonld');
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/schema-org/complex-expanded.jsonld');
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/google/book.jsonld');
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/homepage-sample.html');
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/listing-sample.html');
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
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/jolicampus-formations-symfony.html');
    }
}
