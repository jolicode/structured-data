<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * A hostile document must never crash the process. Deeply nested input used to
 * overflow the C stack (an uncatchable SIGSEGV) when the parsed structure graph
 * was released; a top-level scalar used to reach an uncaught TypeError.
 */
#[Group('security')]
class DocumentSafetyTest extends TestCase
{
    /**
     * @return iterable<string, array{string}>
     */
    public static function provideDeeplyNestedDocuments(): iterable
    {
        // Well beyond the supported depth, both closed and unterminated.
        yield 'nested arrays, closed' => [str_repeat('[', 30000) . str_repeat(']', 30000)];
        yield 'nested arrays, unterminated' => [str_repeat('[', 30000)];
        yield 'nested objects' => [str_repeat('{"a":', 30000) . '1' . str_repeat('}', 30000)];
    }

    #[DataProvider('provideDeeplyNestedDocuments')]
    public function testADeeplyNestedDocumentIsRefusedInsteadOfCrashing(string $document): void
    {
        $audit = (new Validator())->audit($document);

        // The point of the test is that we reach this line at all: the process
        // survived. The document is reported invalid rather than parsed.
        $this->assertFalse($audit->isValid());
        $this->assertNotEmpty($audit->getDiagnostic());
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideTopLevelScalarDocuments(): iterable
    {
        yield 'string' => ['<script type="application/ld+json">"just a string"</script>'];
        yield 'number' => ['<script type="application/ld+json">42</script>'];
        yield 'boolean' => ['<script type="application/ld+json">true</script>'];
    }

    #[DataProvider('provideTopLevelScalarDocuments')]
    public function testATopLevelScalarDocumentIsRefusedInsteadOfThrowing(string $document): void
    {
        $audit = (new Validator())->audit($document);

        $this->assertFalse($audit->isValid());
    }
}
