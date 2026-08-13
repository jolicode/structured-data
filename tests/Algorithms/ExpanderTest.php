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
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

/**
 *  @see https://w3c.github.io/json-ld-api/tests/expand-manifest.html
 * */
#[Group('expand')]
class ExpanderTest extends AbstractJsonLdTestCase
{
    #[DataProvider('provideInputsAndOutputs')]
    public function testExpand(string $json, string|JsonLdException $expected, string $filename): void
    {
        $expander = new Expander(documentLoader: static::createDocumentLoader());
        $options = static::getOptions($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $expander->expand($json, $options);

                throw new AssertionFailedError(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $expected->getMessage()));
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $expanded = $expander->expand($json, $options);

            if (!\is_string($expanded)) {
                throw new AssertionFailedError('The expanded JSON is not a string');
            }

            $this->assertEquals(json_decode($expected), json_decode($expanded));
        }
    }

    protected static function getAlgorithmName(): string
    {
        return Algorithms::EXPAND->value;
    }

    protected static function getExpectedErrorMessage(string $filename): string
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
            'er03-in.jsonld' => 'context overflow',
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
            'er32-in.jsonld' => 'list of lists',
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
            'er56-in.jsonld' => 'keyword redefinition',
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
            'pr42-in.jsonld' => 'protected term redefinition',
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
            'e053-in.jsonld' => 'context overflow',
            'e054-in.jsonld' => 'context overflow',
        ];

        $defaultErrorMessage = <<<'ERROR'
        Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
        However, there is no expected error message in the tests. Maybe the output file was deleted, or the Expander is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected static function shouldSkipThisTest(string $filename): bool
    {
        return false;
    }

    protected static function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: static::getBaseUrlForW3CTests($filename));

        $testSpecificOptions = [
            'c029-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            '0076-in.jsonld' => ['base' => 'http://example/base/'],
            '0077-in.jsonld' => ['expandContext' => 'https://w3c.github.io/json-ld-api/tests/expand/0077-context.jsonld'],
            '0089-in.jsonld' => ['base' => 'http://example/base/'],
            '0090-in.jsonld' => ['base' => 'http://example/base/'],
            'm005-in.jsonld' => ['base' => 'http://example.org/'],
            '0026-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            '0071-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            '0115-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            '0116-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'pi01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er21-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er24-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er32-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'es02-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'es03-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'es01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'er42-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'e053-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'ep02-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
            'tn01-in.jsonld' => ['processingMode' => Context::PROCESSING_MODE_10],
        ];

        if (\array_key_exists($filename, $testSpecificOptions)) {
            foreach ($testSpecificOptions[$filename] as $property => $value) {
                $options->{$property} = $value;
            }
        }

        return $options;
    }
}
