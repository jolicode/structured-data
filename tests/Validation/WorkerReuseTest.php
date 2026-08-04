<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation;

use Jolicode\JsonLd\Audit\AuditOptions;
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * Guards the worker deployment scenario: one long-lived process auditing many
 * distinct, unrelated documents one after the other with the same Validator.
 *
 * Two invariants are protected here:
 * - correctness: the result of auditing a document must not depend on which
 *   documents were audited before it, nor on other Validator instances;
 * - memory: auditing a stream of distinct documents must not grow memory
 *   monotonically (caches must be bounded).
 */
#[Group('validation')]
class WorkerReuseTest extends TestCase
{
    private const FIXTURES = [
        __DIR__ . '/fixtures/google/movie.jsonld',
        __DIR__ . '/fixtures/google/book.jsonld',
        __DIR__ . '/fixtures/google/recipe.jsonld',
        __DIR__ . '/fixtures/schema-org/simple-compacted.jsonld',
        __DIR__ . '/fixtures/schema-org/complex-expanded.jsonld',
        __DIR__ . '/fixtures/extractor/jsonld-valid-multiple.html',
        __DIR__ . '/fixtures/extractor/microdata-valid-single.html',
        __DIR__ . '/fixtures/extractor/wicked-mixed-document.html',
    ];

    public function testAuditingManyDistinctDocumentsIsOrderIndependent(): void
    {
        // Reference: each fixture audited by a pristine Validator.
        $expected = [];

        foreach (self::FIXTURES as $fixture) {
            $expected[$fixture] = $this->diagnose(new Validator(), $fixture);
        }

        // Worker: one Validator audits everything in sequence, twice.
        $worker = new Validator();

        foreach ([1, 2] as $pass) {
            foreach (self::FIXTURES as $fixture) {
                $this->assertSame(
                    $expected[$fixture],
                    $this->diagnose($worker, $fixture),
                    \sprintf('Auditing "%s" (pass %d) with a reused Validator gave a different result than with a fresh one.', basename($fixture), $pass),
                );
            }
        }
    }

    public function testInterleavedValidatorInstancesDoNotInterfere(): void
    {
        $first = new Validator();
        $second = new Validator();

        $first->setValidator(GoogleValidator::class);
        $second->setValidator(SchemaOrgValidator::class);

        $reference = new Validator();
        $reference->setValidator(GoogleValidator::class);
        $expectedGoogle = $this->diagnose($reference, self::FIXTURES[0]);

        $reference = new Validator();
        $reference->setValidator(SchemaOrgValidator::class);
        $expectedSchemaOrg = $this->diagnose($reference, self::FIXTURES[0]);

        // Alternate between the two instances on the same document.
        foreach ([1, 2, 3] as $round) {
            $this->assertSame($expectedGoogle, $this->diagnose($first, self::FIXTURES[0]), \sprintf('Round %d: first instance drifted.', $round));
            $this->assertSame($expectedSchemaOrg, $this->diagnose($second, self::FIXTURES[0]), \sprintf('Round %d: second instance drifted.', $round));
        }
    }

    public function testMemoryStaysFlatWhenAuditingAStreamOfDistinctDocuments(): void
    {
        $validator = new Validator();
        $template = (string) file_get_contents(self::FIXTURES[1]);

        // Warm up all lazily-initialized process-wide structures (vocabulary
        // registries, static schema.org context, autoloaded classes...) so they
        // do not count against the growth measurement below.
        for ($i = 0; $i < 10; ++$i) {
            $validator->audit($this->uniqueDocument($template, 'warmup-' . $i));
        }

        gc_collect_cycles();
        $baseline = memory_get_usage();

        for ($i = 0; $i < 200; ++$i) {
            $validator->audit($this->uniqueDocument($template, 'measured-' . $i));
        }

        gc_collect_cycles();
        $growth = memory_get_usage() - $baseline;

        // 200 distinct ~2 KB documents once flowed through unbounded caches, each
        // pinning its parsed elements, expanded JSON-LD and validated templates
        // (>50 MB overall). With bounded caches, only the last few dozen entries
        // may be retained.
        $this->assertLessThan(
            24 * 1024 * 1024,
            $growth,
            \sprintf('Memory grew by %.1f MB after 200 audits of distinct documents - a cache is probably unbounded.', $growth / 1024 / 1024),
        );
    }

    /**
     * @return array{bool, array<string>}
     */
    private function diagnose(Validator $validator, string $fixture): array
    {
        $audit = $validator->audit($fixture);

        /** @var array<string> $messages */
        $messages = $audit->getDiagnostic(new AuditOptions());
        sort($messages);

        return [$audit->isValid(), $messages];
    }

    private function uniqueDocument(string $template, string $discriminator): string
    {
        // Change the document content so every audit sees a genuinely distinct
        // input (distinct extraction and snippet cache keys).
        return str_replace(
            '"name":',
            \sprintf('"alternateName": "%s", "name":', $discriminator),
            $template,
        );
    }
}
