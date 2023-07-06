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

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\Fixtures\FixturesInstaller;
use Jolicode\JsonLd\Tests\Algorithms\AbstractJsonLdTestCase;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextProcesser;
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

    protected function getAlgorithmName(): string
    {
        return FixturesInstaller::ALGO_PROCESS_CONTEXT;
    }

    protected function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [];

        $defaultErrorMessage = <<<ERROR
            Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
            However, there is no expected error message in the tests. Maybe the output file was deleted, or the ContextProcesser is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [];

        return \in_array($filename, $testsToSkip, true);
    }

    protected function getOptions(string $filename): ProcessorOptions
    {
        // contexts don't use options
        return new ProcessorOptions();
    }

    private function provideContainerEntries(): iterable
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
}
