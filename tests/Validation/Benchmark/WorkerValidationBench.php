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

/**
 * Benchmarks the worker deployment scenario: one long-lived Validator instance
 * auditing a stream of distinct documents. This is the regression guard for the
 * cache lifetime work: every audit sees a genuinely new input, so no
 * content-keyed cache can hit, and memory must stay bounded.
 */
class WorkerValidationBench
{
    private const DOCUMENTS_PER_ITERATION = 25;

    private Validator $validator;

    /**
     * @var array<string>
     */
    private array $documents = [];

    private int $sequence = 0;

    public function setUp(): void
    {
        $this->validator = new Validator();
        $template = (string) file_get_contents(__DIR__ . '/../fixtures/google/book.jsonld');

        // Warm the process-wide vocabulary structures so the benchmark measures
        // the steady state of the worker, not its first request.
        $this->validator->audit($template);
        $this->documents = [];

        for ($i = 0; $i < self::DOCUMENTS_PER_ITERATION; ++$i) {
            $this->documents[] = str_replace(
                '"name":',
                \sprintf('"alternateName": "run-%d-%d", "name":', $this->sequence, $i),
                $template,
            );
        }

        ++$this->sequence;
    }

    /**
     * @BeforeMethods("setUp")
     *
     * @Revs(1)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(5.0)
     */
    public function benchDistinctDocumentsStream(): void
    {
        foreach ($this->documents as $document) {
            $this->validator->audit($document);
        }
    }
}
