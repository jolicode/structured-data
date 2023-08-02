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

use Jolicode\JsonLd\Validation\JsonLdValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @covers \Jolicode\JsonLd\Validation\JsonLdValidator
 *
 * @group validation
 */
class JsonLdValidatorTest extends TestCase
{
    private JsonLdValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new JsonLdValidator();
    }

    /** @dataProvider provideFilesToValidate */
    public function testValidate(string $document, bool $isValid, array $messages): void
    {
        $json = file_get_contents($document);
        $map = $this->validator->validate($json);

        $this->assertSame($isValid, $map->isValid());

        if (!$isValid) {
            foreach ($map->getErrorMessages() as $actualMessage) {
                $this->assertContains($actualMessage, $messages);
            }
        }
    }

    /** @dataProvider provideExamples */
    // public function testValidateBis(string $document): void
    // {
    //     $json = file_get_contents($document);
    //     $map = $this->validator->validate($json);

    //     if (!$map->isValid()) {
    //         dump($document, $map->getErrorMessages());
    //     }

    //     $this->assertTrue(true);
    // }

    public function provideExamples(): \Generator
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../ressources/SchemaOrg/examples');

        foreach ($finder as $file) {
            yield $file->getFilename() => [$file->getPathname()];
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
        // TODO: This test shows a concerning issue.
        // TODO: Because we are validating some expanded inputs, there may be a mismatch on the type keys between the expanded input and the parsed input.
        // TODO: Since this test is a bit weird, we'll wait until we have a better test suite to look into it.
        // TODO: It would be really sad to have to compact the entries if a key is not found... At least we already have that algorithm.
        // yield 'Test external URL are incorrect types' => [
        //     'document' => __DIR__ . '/fixtures/external-types.jsonld',
        //     'isValid' => false,
        //     'messages' => [
        //         'This type is not a valid Schema.org type: http://example.org/vocab#Library',
        //         'This type is not a valid Schema.org type: http://example.org/vocab#Book',
        //         'This type is not a valid Schema.org type: http://example.org/vocab#Chapter',
        //     ],
        // ];
        yield 'Test bad attribute is invalid' => [
            'document' => __DIR__ . '/fixtures/bad-attribute.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute.'],
        ];
        yield 'Test nested bad attribute is invalid' => [
            'document' => __DIR__ . '/fixtures/bad-attribute-nested-1.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute.'],
        ];
        yield 'Test nested bad attribute is invalid bis' => [
            'document' => __DIR__ . '/fixtures/bad-attribute-nested-2.jsonld',
            'isValid' => false,
            'messages' => [
                'This property does not exist: wrongOne.',
                'This property does not exist: badAgain.',
                'The property "telephone" does not exist on the type "DataDownload".',
            ],
        ];
        yield 'Test missing type entry is invalid' => [
            'document' => __DIR__ . '/fixtures/no-type.jsonld',
            'isValid' => false,
            'messages' => ['The @type entry of this type is missing.'],
        ];
        yield 'Test missing typed value type entry generates warning' => [
            'document' => __DIR__ . '/fixtures/no-type-nested.jsonld',
            'isValid' => false,
            'messages' => ['The @type entry of this typed value was not set. We had to guess it from its properties.'],
        ];
        yield 'Test parent attributes are working' => [
            'document' => __DIR__ . '/fixtures/valid-parent-attribute.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test wrong parent attribute' => [
            'document' => __DIR__ . '/fixtures/wrong-parent-attribute.jsonld',
            'isValid' => false,
            'messages' => ['The "makesOffer" property does not accept the "Intangible" type as a value.'],
        ];
        yield 'Test multiple types on node object is valid' => [
            'document' => __DIR__ . '/fixtures/multiple-types-1.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test multiple types on typed value is invalid' => [
            'document' => __DIR__ . '/fixtures/multiple-types-2.jsonld',
            'isValid' => false,
            'messages' => ['A typed value may only have one type, 2 provided.'],
        ];
    }
}
