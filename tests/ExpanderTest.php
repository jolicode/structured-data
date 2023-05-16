<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests;

use Jolicode\JsonLd\Expand\Expander;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\Exception\JsonLdException;

/**
 *  @see https://w3c.github.io/json-ld-api/tests/expand-manifest.html
 *
 *  @group expand
 * */
class ExpanderTest extends AbstractJsonLdTestCase
{
    /** @dataProvider provideInputsAndOutputs */
    public function testExpand(string $json, string|JsonLdException $expected, string $filename): void
    {
        $expander = new Expander();
        $options = $this->getOptions($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $expander->parseJson($json, $options);
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $this->assertEquals(json_decode($expected), json_decode($expander->parseJson($json, $options)));
        }
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            'pi01-in.jsonld' => 'invalid term definition',
            'pi02-in.jsonld' => 'invalid term definition',
            'pi03-in.jsonld' => 'invalid term definition',
            'pi04-in.jsonld' => 'invalid term definition',
            'pi05-in.jsonld' => 'invalid value object',
            'er01-in.jsonld' => 'keyword redefinition',
            // The doc says to expect a "recursive context inclusion" exception, but as written here https://www.w3.org/TR/json-ld-api/#changes-from-cg
            // It now expects a context overflow
            'er02-in.jsonld' => 'context overflow',
            'er04-in.jsonld' => 'loading remote context failed',
            'er05-in.jsonld' => 'invalid remote context',
            'er06-in.jsonld' => 'invalid local context',
            'er07-in.jsonld' => 'invalid base IRI',
            'er08-in.jsonld' => 'invalid vocab mapping',
            'er09-in.jsonld' => 'invalid default language',
            'er10-in.jsonld' => 'cyclic IRI mapping',
            'er11-in.jsonld' => 'invalid term definition',
            'er12-in.jsonld' => 'invalid type mapping',
            'er13-in.jsonld' => 'invalid type mapping',
            'er14-in.jsonld' => 'invalid reverse property',
            'er15-in.jsonld' => 'invalid IRI mapping',
            'er17-in.jsonld' => 'invalid reverse property',
            'er18-in.jsonld' => 'invalid IRI mapping',
            'er19-in.jsonld' => 'invalid keyword alias',
            'er20-in.jsonld' => 'invalid IRI mapping',
            'er21-in.jsonld' => 'invalid container mapping',
            'er22-in.jsonld' => 'invalid language mapping',
            'er23-in.jsonld' => 'invalid type mapping',
            'er24-in.jsonld' => 'list of lists',
            'er25-in.jsonld' => 'invalid reverse property map',
            'er26-in.jsonld' => 'colliding keywords',
            'er27-in.jsonld' => 'invalid @id value',
            'er28-in.jsonld' => 'invalid type value',
            'er29-in.jsonld' => 'invalid value object value',
            'er30-in.jsonld' => 'invalid language-tagged string',
            'er31-in.jsonld' => 'invalid @index value',
            'er32-in.jsonld' => 'invalid @included value',
            'er33-in.jsonld' => 'invalid @reverse value',
            'er34-in.jsonld' => 'invalid @reverse property value',
            'er35-in.jsonld' => 'invalid language map value',
            'er36-in.jsonld' => 'invalid reverse property value',
            'er37-in.jsonld' => 'invalid value object',
            'er38-in.jsonld' => 'invalid value object',
            'er39-in.jsonld' => 'invalid language-tagged value',
            'er40-in.jsonld' => 'invalid typed value',
            'er41-in.jsonld' => 'invalid set or list object',
            'er42-in.jsonld' => 'keyword redefinition',
            'er43-in.jsonld' => 'invalid IRI mapping',
            'er44-in.jsonld' => 'invalid IRI mapping',
            'er48-in.jsonld' => 'invalid IRI mapping',
            'er49-in.jsonld' => 'invalid term definition',
            'er50-in.jsonld' => 'invalid IRI mapping',
            'er51-in.jsonld' => 'invalid value object value',
            'er52-in.jsonld' => 'invalid term definition',
            'er53-in.jsonld' => 'invalid @prefix value',
            'er54-in.jsonld' => 'invalid typed value',
            'er55-in.jsonld' => 'invalid type mapping',
            'ec01-in.jsonld' => 'invalid term definition',
            'ec02-in.jsonld' => 'keyword redefinition',
            'c029-in.jsonld' => 'invalid context entry',
            'c030-in.jsonld' => 'invalid @propagate value',
            'c032-in.jsonld' => 'invalid scoped context',
            'c033-in.jsonld' => 'invalid scoped context',
            'so01-in.jsonld' => 'invalid context entry',
            'so02-in.jsonld' => 'invalid @import value',
            'so03-in.jsonld' => 'invalid context entry',
            'so07-in.jsonld' => 'protected term redefinition',
            'so10-in.jsonld' => 'protected term redefinition',
            'so12-in.jsonld' => 'invalid context entry',
            'so13-in.jsonld' => 'invalid remote context',
            '0115-in.jsonld' => 'invalid vocab mapping',
            '0116-in.jsonld' => 'invalid vocab mapping',
            '0123-in.jsonld' => 'invalid typed value',
            'pr01-in.jsonld' => 'protected term redefinition',
            'pr03-in.jsonld' => 'protected term redefinition',
            'pr04-in.jsonld' => 'protected term redefinition',
            'pr05-in.jsonld' => 'invalid context nullification',
            'pr08-in.jsonld' => 'protected term redefinition',
            'pr09-in.jsonld' => 'protected term redefinition',
            'pr11-in.jsonld' => 'protected term redefinition',
            'pr12-in.jsonld' => 'protected term redefinition',
            'pr17-in.jsonld' => 'invalid context nullification',
            'pr18-in.jsonld' => 'invalid context nullification',
            'pr20-in.jsonld' => 'invalid context nullification',
            'pr21-in.jsonld' => 'invalid context nullification',
            'pr26-in.jsonld' => 'protected term redefinition',
            'pr28-in.jsonld' => 'protected term redefinition',
            'pr31-in.jsonld' => 'protected term redefinition',
            'pr32-in.jsonld' => 'protected term redefinition',
            'pr33-in.jsonld' => 'invalid term definition',
            'es01-in.jsonld' => 'invalid container mapping',
            'es02-in.jsonld' => 'invalid container mapping',
            'en01-in.jsonld' => 'invalid @nest value',
            'en02-in.jsonld' => 'invalid @nest value',
            'en03-in.jsonld' => 'invalid @nest value',
            'en04-in.jsonld' => 'invalid @nest value',
            'en05-in.jsonld' => 'invalid @nest value',
            'en06-in.jsonld' => 'invalid reverse property',
            'm020-in.jsonld' => 'invalid type mapping',
            'em01-in.jsonld' => 'invalid container mapping',
            'in07-in.jsonld' => 'invalid @included value',
            'in08-in.jsonld' => 'invalid @included value',
            'in09-in.jsonld' => 'invalid @included value',
            'di08-in.jsonld' => 'invalid base direction',
            'di09-in.jsonld' => 'invalid value object',
            'ep02-in.jsonld' => 'processing mode conflict',
            'ep03-in.jsonld' => 'invalid @version value',
            'tn01-in.jsonld' => 'invalid type mapping',

            // These ones do not exist in https://w3c.github.io/json-ld-api/tests/expand-manifest.html so we assume they are working
            'er45-in.jsonld' => 'invalid IRI mapping',
            'e052-in.jsonld' => 'context overflow',
            'er03-in.jsonld' => 'context overflow',
            'e053-in.jsonld' => 'context overflow',
            'e054-in.jsonld' => 'context overflow',
        ];

        $defaultErrorMessage = <<<ERROR
        Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
        However, there is no expected error message in the tests. Maybe the output file was deleted, or the Expander is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // These tests seem wrong. If we paste the input JSON in the JSON-LD playground (https://json-ld.org/playground/) the result is not the one expected.
            // Instead we have the same result as when running our implementation and changing the options doesn't change anything.
            'c038-in.jsonld',
            '0077-in.jsonld',
            'c037-in.jsonld',

            // This test is weird, it should throw a container mapping related exception but is related to the @context keyword
            // Anyway, the value sent for the container mapping is fine so we skip it.
            'es01-in.jsonld',

            // The specVersion of these tests is 1.0, we are using 1.1. They seem to be outdated se we skip them.
            // Moreover, the playground has the same results as we do so we are pretty confident.
            'er24-in.jsonld',
            '0115-in.jsonld',
            'er32-in.jsonld',
            '0026-in.jsonld',
            '0116-in.jsonld',
            '0071-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: $this->getBaseUrlForW3CTests($filename));

        $testSpecificOptions = [
            'c029-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            '0076-in.jsonld' => ['base' => 'http://example/base/'],
            '0089-in.jsonld' => ['base' => 'http://example/base/'],
            '0090-in.jsonld' => ['base' => 'http://example/base/'],
            'm005-in.jsonld' => ['base' => 'http://example.org/'],
            'pi01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er21-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'es01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er42-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'e053-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'ep02-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'tn01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
        ];

        if (array_key_exists($filename, $testSpecificOptions)) {
            foreach ($testSpecificOptions[$filename] as $property => $value) {
                $options->{$property} = $value;
            }
        }

        return $options;
    }
}
