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
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
use Jolicode\JsonLd\Validation\Validators\Google\GoogleValidator;
use Jolicode\JsonLd\Validation\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @covers \Jolicode\JsonLd\Validation\JsonLdValidator
 * @covers \Jolicode\JsonLd\Validation\Validators\SchemaOrgValidator
 * @covers \Jolicode\JsonLd\Validation\Validators\GoogleValidator
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

    /**
     * @group schemaorg
     *
     * @dataProvider provideSchemaOrgFiles
     */
    public function testSchemaOrgValidator(string $filePath, bool $isValid, array $expectedMessages): void
    {
        $this->testValidate($filePath, $isValid, $expectedMessages, SchemaOrgValidator::class);
    }

    /**
     * @group google
     *
     * @dataProvider provideGoogleFiles
     */
    // public function testGoogleValidator(string $filePath, bool $isValid, array $expectedMessages): void
    // {
    //     $this->testValidate($filePath, $isValid, $expectedMessages, GoogleValidator::class);
    // }

    /**
     * @group schemaorg
     *
     * @dataProvider provideExamples
     */
    public function testValidateBis(string $filePath): void
    {
        $this->testValidate($filePath, true, [], SchemaOrgValidator::class);
    }

    public function provideExamples(): \Generator
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../../ressources/SchemaOrg/examples');

        foreach ($finder as $file) {
            yield $file->getFilename() => [$file->getPathname()];
        }
    }

    public function provideSchemaOrgFiles(): \Generator
    {
        $path = __DIR__ . '/fixtures/SchemaOrg';

        yield 'Simple compacted input' => [
            'document' => $path . '/simple-compacted.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple expanded input' => [
            'document' => $path . '/simple-expanded.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple flattened input' => [
            'document' => $path . '/simple-flattened.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Simple framed input' => [
            'document' => $path . '/simple-framed.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex compacted input' => [
            'document' => $path . '/complex-compacted.jsonld',
            'isValid' => true,
            'messages' => [
            ],
        ];
        yield 'Complex expanded input' => [
            'document' => $path . '/complex-expanded.jsonld',
            'isValid' => true,
            'messages' => [
            ],
        ];
        yield 'Complex flattened input' => [
            'document' => $path . '/complex-flattened.jsonld',
            'isValid' => true,
            'messages' => [
            ],
        ];
        yield 'Complex framed input' => [
            'document' => $path . '/complex-framed.jsonld',
            'isValid' => true,
            'messages' => [
            ],
        ];
        yield 'Test external URL are incorrect types' => [
            'document' => $path . '/external-types.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test bad attribute is invalid' => [
            'document' => $path . '/bad-attribute.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute'],
        ];
        yield 'Test nested bad attribute is invalid' => [
            'document' => $path . '/bad-attribute-nested-1.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute'],
        ];
        yield 'Test nested bad attribute is invalid bis' => [
            'document' => $path . '/bad-attribute-nested-2.jsonld',
            'isValid' => false,
            'messages' => [
                'This property does not exist: badAgain',
                'The property "telephone" does not exist on the type "DataDownload"',
                'This property does not exist: wrongOne',
            ],
        ];
        yield 'Test missing main type entry is invalid' => [
            'document' => $path . '/no-type-main.jsonld',
            'isValid' => false,
            'messages' => [
                'Missing a @type entry. The @type entry is mandatory for root types',
            ],
        ];
        yield 'Test missing typed value type entry generates warning' => [
            'document' => $path . '/no-type-nested.jsonld',
            'isValid' => false,
            'messages' => [
                'The @type entry of this type was not set. We had to guess it from its properties. The guessed type is: Thing',
                'The "birthPlace" property does not accept the "Thing" type as a value',
                'The property "address" does not exist on the type "Thing"',
                'The property "faxNumber" does not exist on the type "Thing"',
                'The property "slogan" does not exist on the type "Thing"',
            ],
        ];
        yield 'Test parent attributes are working' => [
            'document' => $path . '/valid-parent-attribute.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test wrong parent attribute' => [
            'document' => $path . '/wrong-parent-attribute.jsonld',
            'isValid' => false,
            'messages' => ['The "makesOffer" property does not accept the "Intangible" type as a value'],
        ];
        yield 'Test multiple types on node object is valid' => [
            'document' => $path . '/multiple-types-1.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test multiple types on typed value is invalid' => [
            'document' => $path . '/multiple-types-2.jsonld',
            'isValid' => false,
            'messages' => ['A typed value may only have one type, 2 provided'],
        ];
        yield 'Test invalid multiple type work properly' => [
            'document' => $path . '/multiple-types-invalid.jsonld',
            'isValid' => false,
            'messages' => ['The property "acrissCode" does not exist on any of these types: "Person, Organization"'],
        ];
        yield 'Test invalid JSON document' => [
            'document' => $path . '/invalid-json.jsonld',
            'isValid' => false,
            'messages' => ['Parsing error in [3:5]. Expected \',\' or \'}\' while parsing object. Got: "'],
        ];
        yield 'Test expansion exceptions are correctly sent' => [
            'document' => $path . '/expansion-exception.jsonld',
            'isValid' => false,
            'messages' => ['invalid type mapping'],
        ];
        yield 'Test extracting a valid JSON-LD document from a web page' => [
            'document' => 'https://jolicode.com/blog/jouer-de-la-musique-dans-le-navigateur-avec-la-web-audio-api',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test validating a page with A LOT of JSON-LD tags' => [
            'document' => 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/examples.txt',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test actions work properly' => [
            'document' => $path . '/action.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test a lot of different errors on a compacted format' => [
            'document' => $path . '/compacted-with-lots-of-errors.jsonld',
            'isValid' => false,
            'messages' => [
                'The "Orgaanization" type is not a valid Schema.org type',
                'The @type entry of this type was not set. We had to guess it from its properties. The guessed type is: Thing',
                'This property does not exist: badAgain',
                'The property "contactType" does not exist on the type "Thing"',
                'The property "email" does not exist on the type "Thing"',
                'The property "telephone" does not exist on the type "Thing"',
                'This property does not exist: contactaPoint',
                'This property does not exist: creaator',
                'The property "telephone" does not exist on the type "DataDownload"',
                'This property does not exist: wrongOne',
                'A typed value may only have one type, 2 provided',
            ],
        ];
        yield 'Test classic HTML document' => [
            'document' => $path . '/html-classic.html',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test HTML document with two json-ld script tags' => [
            'document' => $path . '/html-double-tags.html',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test HTML document with no script tag' => [
            'document' => $path . '/html-no-tag.html',
            'isValid' => false,
            'messages' => [
                'No JSON-LD elements were found in this document',
            ],
        ];
    }

    private function testValidate(string $filePath, bool $isValid, array $expectedMessages, string $specificValidator): void
    {
        $maps = $this->validator->validate($filePath, $specificValidator);

        $containsErrors = false;

        foreach ($maps as $map) {
            if (!$map->isValid()) {
                $containsErrors = true;
            }

            if (!$isValid) {
                $foundErrorMessages = array_filter(
                    $maps,
                    fn (ValidationMap $map) => !$map->isValid(),
                );

                $foundErrorMessages = array_reduce(
                    $foundErrorMessages,
                    fn (array $carry, ValidationMap $map) => array_merge($carry, $map->getErrorMessages()),
                    [],
                );

                $this->assertSame($expectedMessages, $foundErrorMessages);
            }
        }

        $this->assertSame($isValid, !$containsErrors);
    }

    private function provideGoogleFiles(): \Generator
    {
        $path = __DIR__ . '/fixtures/Google';

        yield 'Article' => [
            'document' => $path . '/article.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        // An absolute mess ¯\_(ツ)_/¯
        yield 'Book' => [
            'document' => $path . '/book.jsonld',
            'isValid' => false,
            'messages' => [
                // Weird... The LibrarySystem type definition says URL is required, but the the Google validator does not...
                'Missing required property: "url"',
            ],
        ];

        yield 'Breadcrumb' => [
            'document' => $path . '/breadcrumb.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Carousel' => [
            'document' => $path . '/carousel.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Course Info' => [
            'document' => $path . '/course-info.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Course' => [
            'document' => $path . '/course.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Covid19' => [
            'document' => $path . '/covid19.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Dataset' => [
            'document' => $path . '/dataset.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Tabular Dataset' => [
            'document' => $path . '/dataset-tabular.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Recipe' => [
            'document' => $path . '/recipe.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
    }
}
