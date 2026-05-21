<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms;

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextCache;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\TermDefinition\TermDefinition;
use Jolicode\JsonLd\Algorithms\TermDefinition\TermDefinitionCreator;

/** @group context */
class ContextProcesserTest extends AbstractJsonLdTestCase
{
    /**
     * The files provided by the W3C only test that the context is correctly extracted, it doesn't test the processing algorithm in itself.
     * The algorithm doesn't have its own proper tests : its validity is tested in the other algorithms tests.
     *
     * @dataProvider provideInputsAndOutputs
     * */
    public function testProcessContext(string $json, string $expected): void
    {
        $processer = new ContextProcesser();
        $actual = new \stdClass();
        $extractedContext = $processer->extractContext(json_decode($json));

        if ($extractedContext) {
            $actual->{Keyword::CONTEXT->value} = $extractedContext;
        }

        $this->assertEquals(json_decode($expected), $actual);
    }

    /** @dataProvider provideContainerEntries */
    public function testValidateContainerEntry(string|array $container, bool $expected): void
    {
        $this->assertSame($expected, TermDefinitionCreator::validateContainerEntry($container));
    }

    public function testCachedRemoteContextReturnsIsolatedCopies(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'jsonld-context-');

        if (false === $path) {
            self::fail('Failed to create a temporary context file.');
        }

        file_put_contents($path, '{"@context":{"name":"https://schema.org/name"}}');

        try {
            $processer = new ContextProcesser();

            $first = $processer->processContext(new Context(), $path);
            $first->termDefinitions['name'] = new TermDefinition(
                prefixFlag: false,
                protected: false,
                reverseProperty: false,
                iriMapping: 'https://example.com/mutated',
            );

            $second = $processer->processContext(new Context(), $path);

            $this->assertSame('https://schema.org/name', $second->termDefinitions['name']->iriMapping);
            $this->assertNotSame($first, $second);
            $this->assertNotSame($first->termDefinitions['name'], $second->termDefinitions['name']);
        } finally {
            @unlink($path);
        }
    }

    public function testSchemaOrgStaticContextIsUsedWhenBaseUrlIsSet(): void
    {
        $cache = new ContextCache();
        $context = new Context(
            baseIri: 'https://example.com/page',
            baseUrl: 'https://example.com/page',
            processingMode: Context::PROCESSING_MODE_11,
        );

        $remoteContexts = ['https://schema.org/'];
        $processed = $cache->getProcessedRemoteContext($context, 'https://schema.org/', true, $remoteContexts);

        $this->assertNotNull($processed);
        $this->assertSame('http://schema.org/', $processed->vocabularyMapping);
        $this->assertArrayHasKey('name', $processed->termDefinitions);
        $this->assertSame('http://schema.org/name', $processed->termDefinitions['name']->iriMapping);
        $this->assertSame('https://example.com/page', $processed->baseUrl);
        $this->assertSame('https://example.com/page', $processed->baseIri);
    }

    public function provideContainerEntries(): iterable
    {
        yield 'correct keyword returns true' => [
            'container' => Keyword::GRAPH->value,
            'expected' => true,
        ];
        yield 'wrong keyword returns false' => [
            'container' => Keyword::IMPORT->value,
            'expected' => false,
        ];
        yield 'array with exactly 1 correct keyword returns true' => [
            'container' => [Keyword::GRAPH->value],
            'expected' => true,
        ];
        yield 'array with more than 1 entry returns false even with good keyword' => [
            'container' => [Keyword::GRAPH->value, 'I should return false'],
            'expected' => false,
        ];
        yield 'array with graph entry and good keyword returns true' => [
            'container' => [Keyword::GRAPH->value, Keyword::INDEX->value],
            'expected' => true,
        ];
        yield 'array with set entry and good keyword returns true' => [
            'container' => [Keyword::SET->value, Keyword::INDEX->value],
            'expected' => true,
        ];
        yield 'array with set entry and list keyword returns false' => [
            'container' => [Keyword::SET->value, Keyword::LIST->value],
            'expected' => false,
        ];
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::CONTEXT->value;
    }

    protected function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            'fake' => 'Add below the error message you expect for this test',
        ];

        $defaultErrorMessage = <<<'ERROR'
            Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
            However, there is no expected error message in the tests. Maybe the output file was deleted, or the ContextProcesser is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            'fake', // Add below the filename of the test you want to skip
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected function getOptions(string $filename): ProcessorOptions
    {
        // contexts don't use options
        return new ProcessorOptions();
    }
}
