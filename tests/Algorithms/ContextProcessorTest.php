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
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextCache;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinitionEntryHandler;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('context')]
class ContextProcessorTest extends AbstractJsonLdTestCase
{
    /**
     * The files provided by the W3C only test that the context is correctly extracted, it doesn't test the processing algorithm in itself.
     * The algorithm doesn't have its own proper tests : its validity is tested in the other algorithms tests.
     * */
    #[DataProvider('provideInputsAndOutputs')]
    public function testProcessContext(string $json, string $expected, string $filename): void
    {
        $processer = new ContextProcessor(new ContextCache(static::createDocumentLoader()));
        $actual = new \stdClass();
        $extractedContext = $processer->extractContext(json_decode($json));

        if ($extractedContext) {
            $actual->{Keyword::CONTEXT->value} = $extractedContext;
        }

        $this->assertEquals(json_decode($expected), $actual);
    }

    #[DataProvider('provideContainerEntries')]
    public function testValidateContainerEntry(string|array $container, bool $expected): void
    {
        $this->assertSame($expected, TermDefinitionEntryHandler::validateContainerEntry($container));
    }

    public function testCachedRemoteContextReturnsIsolatedCopies(): void
    {
        $loader = new class implements DocumentLoaderInterface {
            public function load(string $url): \stdClass
            {
                return (object) json_decode('{"@context":{"name":"https://schema.org/name"}}');
            }

            public function getCacheNamespace(): string
            {
                // Own namespace: the processed context cache is process-wide and
                // the test execution order is random.
                return 'test:isolated-copies';
            }
        };

        $processer = new ContextProcessor(new ContextCache($loader));
        $url = 'https://tests.invalid/isolated-copies/context.jsonld';
        $baseContext = static fn (): Context => new Context(baseUrl: 'https://tests.invalid/');

        $first = $processer->processContext($baseContext(), $url);
        $first->termDefinitions['name'] = new TermDefinition(
            prefixFlag: false,
            protected: false,
            reverseProperty: false,
            iriMapping: 'https://example.com/mutated',
        );

        $second = $processer->processContext($baseContext(), $url);

        $this->assertSame('https://schema.org/name', $second->termDefinitions['name']->iriMapping);
        $this->assertNotSame($first, $second);
        $this->assertNotSame($first->termDefinitions['name'], $second->termDefinitions['name']);
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

    public static function provideContainerEntries(): iterable
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

    protected static function getAlgorithmName(): string
    {
        return Algorithms::CONTEXT->value;
    }

    protected static function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            'fake' => 'Add below the error message you expect for this test',
        ];

        $defaultErrorMessage = <<<'ERROR'
            Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
            However, there is no expected error message in the tests. Maybe the output file was deleted, or the ContextProcessor is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected static function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            'fake', // Add below the filename of the test you want to skip
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected static function getOptions(string $filename): ProcessorOptions
    {
        // contexts don't use options
        return new ProcessorOptions();
    }
}
