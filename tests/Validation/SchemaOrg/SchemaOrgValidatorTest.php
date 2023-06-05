<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation\SchemaOrg;

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Parser\UserEntryParser;
use Jolicode\JsonLd\Validation\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicode\JsonLd\Validation\JsonLdValidator
 *
 * @group validation
 */
class SchemaOrgValidatorTest extends TestCase
{
    private Expander $expander;
    private SchemaOrgValidator $validator;

    protected function setUp(): void
    {
        $this->expander = new Expander();
        $this->validator = new SchemaOrgValidator();
    }

    /** @dataProvider provideFilesToValidate */
    public function testValidate(string $document, array $expected): void
    {
        $json = file_get_contents($document);

        $sourceMapper = new UserEntryParser();
        $sourceMap = $sourceMapper->parse($json);
        $options = new ProcessorOptions(
            base: 'http://schema.org/',
        );

        $expanded = $this->expander->parseJson($json, $options, encodeResult: false);
        $result = $this->validator->validate($expanded, $sourceMap);

        $this->assertSame($expected, $result->getErrorMessages());
    }

    public function provideFilesToValidate(): \Generator
    {
        // yield 'person' => [
        //     'document' => __DIR__ . '/fixtures/person.jsonld',
        //     'expected' => [],
        // ];
        yield '01' => [
            'document' => __DIR__ . '/fixtures/01.jsonld',
            'expected' => [],
        ];
    }
}
