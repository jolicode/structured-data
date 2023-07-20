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

use Jolicode\JsonLd\Validation\JsonLdValidator;
use Jolicode\JsonLd\Validation\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicode\JsonLd\Validation\SchemaOrg\SchemaOrgValidator
 *
 * @group validation
 */
class SchemaOrgValidatorTest extends TestCase
{
    private SchemaOrgValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new SchemaOrgValidator();
    }

    /** @dataProvider provideFilesToValidate */
    public function testValidate(string $document, bool $isValid, array $messages): void
    {
        $json = file_get_contents($document);
        $aaa = new JsonLdValidator();
        $aaa->validate($json);
        $validationResult = $this->validator->validate($json);

        $this->assertSame($isValid, $validationResult->isValid());

        if (!$isValid) {
            foreach ($validationResult->getErrorMessages() as $actualMessage) {
                $this->assertContains($actualMessage, $messages);
            }
        }
    }

    public function provideFilesToValidate(): \Generator
    {
        yield 'Simple compacted input' => [
            'document' => __DIR__ . '/fixtures/simple-compacted.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple expanded input' => [
            'document' => __DIR__ . '/fixtures/simple-expanded.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple flattened input' => [
            'document' => __DIR__ . '/fixtures/simple-flattened.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple framed input' => [
            'document' => __DIR__ . '/fixtures/simple-framed.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex compacted input' => [
            'document' => __DIR__ . '/fixtures/complex-compacted.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex expanded input' => [
            'document' => __DIR__ . '/fixtures/complex-expanded.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex flattened input' => [
            'document' => __DIR__ . '/fixtures/complex-flattened.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex framed input' => [
            'document' => __DIR__ . '/fixtures/complex-framed.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test external URL are incorrect types' => [
            'document' => __DIR__ . '/fixtures/external-types.jsonld',
            'isValid' => false,
            'messages' => [
                'This type is not a valid Schema.org type: http://example.org/vocab#Library',
                'This type is not a valid Schema.org type: http://example.org/vocab#Book',
                'This type is not a valid Schema.org type: http://example.org/vocab#Chapter',
            ],
        ];
        yield 'Test bad attribute is invalid' => [
            'document' => __DIR__ . '/fixtures/bad-attribute.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist in Schema.org: imABadAttribute'],
        ];
        yield 'Test nested bad attribute is invalid' => [
            'document' => __DIR__ . '/fixtures/bad-attribute-nested.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist in Schema.org: imABadAttribute'],
        ];
        yield 'Test nested bad attribute is invalid bis' => [
            'document' => __DIR__ . '/fixtures/bad-attribute-nested-2.jsonld',
            'isValid' => false,
            'messages' => [
                'This property does not exist in Schema.org: wrongOne',
                'This property does not exist in Schema.org: badAgain',
                'The property "telephone" does not exist on the type "DataDownload" in Schema.org',
            ],
        ];
        yield 'Test missing type entry is invalid' => [
            'document' => __DIR__ . '/fixtures/no-type.jsonld',
            'isValid' => false,
            'messages' => ['This type misses a @type property'],
        ];
        yield 'Test parent attributes are working' => [
            'document' => __DIR__ . '/fixtures/valid-parent-attribute.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test wrong parent attribute' => [
            'document' => __DIR__ . '/fixtures/wrong-parent-attribute.jsonld',
            'isValid' => false,
            'messages' => ['The "makesOffer" attribute does not accept the "Intangible" type as a value in Schema.org'],
        ];
    }
}
