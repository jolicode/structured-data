<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Benchmark;

use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;

class CompactorBench extends AbstractJsonLdBench
{
    private const EXPANDED_PERSON = '[{"@type":["http://schema.org/Person"],"http://schema.org/name":[{"@value":"John Doe"}],"http://schema.org/jobTitle":[{"@value":"Developer"}]}]';

    public function __construct(
        private readonly Compactor $compactor = new Compactor(),
    ) {
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchInlineContextCompaction(): void
    {
        $this->compactor->compact(
            self::EXPANDED_PERSON,
            (object) ['name' => 'http://schema.org/name', 'jobTitle' => 'http://schema.org/jobTitle'],
        );
    }

    /**
     * Compaction against the bundled schema.org context, served from the static
     * vocabulary data (no outbound request).
     *
     * @Revs(20)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSchemaOrgContextCompaction(): void
    {
        $this->compactor->compact(self::EXPANDED_PERSON, 'https://schema.org');
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::COMPACT->value;
    }
}
