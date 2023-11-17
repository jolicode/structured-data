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

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Validation\Extraction\JsonLdNodeExtractor;
use Jolicode\JsonLd\Validation\JsonLdValidator;
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
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
    private JsonLdNodeExtractor $extractor;

    protected function setUp(): void
    {
        $this->validator = new JsonLdValidator();
        $this->extractor = new JsonLdNodeExtractor();
    }

    /**
     * @dataProvider provideSchemaOrgFiles
     * @dataProvider provideGoogleFiles
     */
    public function testValidate(string $filePath, bool $isValid, array $expectedMessages): void
    {
        $maps = [];

        if (IriResolver::isAbsoluteIri($filePath)) {
            $jsonLd = $this->extractor->extractJsonLd($filePath);

            foreach ($jsonLd as $jsonLdItem) {
                $maps = array_merge($maps, $this->validator->validate($jsonLdItem));
            }
        } else {
            $maps = $this->validator->validate(file_get_contents($filePath));
        }

        $containsErrors = false;

        $foundErrorMessages = array_filter(
            $maps,
            fn (ValidationMap $map) => !$map->isValid()
        );

        $foundErrorMessages = array_reduce(
            $foundErrorMessages,
            fn (array $carry, ValidationMap $map) => array_merge($carry, $map->getErrorMessages()),
            []
        );

        foreach ($maps as $map) {
            if (!$map->isValid()) {
                $containsErrors = true;
            }

            if (!$isValid) {
                foreach ($foundErrorMessages as $actualMessage) {
                    $this->assertSame($expectedMessages, $foundErrorMessages);
                }
            }
        }

        $this->assertSame($isValid, !$containsErrors);
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
            'messages' => [],
        ];
        yield 'Complex expanded input' => [
            'document' => $path . '/complex-expanded.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex flattened input' => [
            'document' => $path . '/complex-flattened.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Complex framed input' => [
            'document' => $path . '/complex-framed.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test external URL are incorrect types' => [
            'document' => $path . '/external-types.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test bad attribute is invalid' => [
            'document' => $path . '/bad-attribute.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute.'],
        ];
        yield 'Test nested bad attribute is invalid' => [
            'document' => $path . '/bad-attribute-nested-1.jsonld',
            'isValid' => false,
            'messages' => ['This property does not exist: imABadAttribute.'],
        ];
        yield 'Test nested bad attribute is invalid bis' => [
            'document' => $path . '/bad-attribute-nested-2.jsonld',
            'isValid' => false,
            'messages' => [
                'This property does not exist: badAgain.',
                'The property "telephone" does not exist on the type "DataDownload".',
                'This property does not exist: wrongOne.',
            ],
        ];
        yield 'Test missing type entry is invalid' => [
            'document' => $path . '/no-type.jsonld',
            'isValid' => false,
            'messages' => [
                'The @type entry of this type was not set. We had to guess it from its properties.',
                'The @type entry of this type is missing. Google will ignore this type.',
            ],
        ];
        yield 'Test missing typed value type entry generates warning' => [
            'document' => $path . '/no-type-nested.jsonld',
            'isValid' => false,
            'messages' => [
                'The @type entry of this type was not set. We had to guess it from its properties.',
                'The @type entry of this type is missing. Google will ignore this type.',
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
            'messages' => ['The "makesOffer" property does not accept the "Intangible" type as a value.'],
        ];
        yield 'Test multiple types on node object is valid' => [
            'document' => $path . '/multiple-types-1.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
        yield 'Test multiple types on typed value is invalid' => [
            'document' => $path . '/multiple-types-2.jsonld',
            'isValid' => false,
            'messages' => ['A typed value may only have one type, 2 provided.'],
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
            'isValid' => false,
            'messages' => [
                'Missing recommended property: "name"',
                'Incorrect URL: "wells-fargo-center.html" given.',
                'Missing required property: "url"',
                'Missing recommended property: "availability"',
                'Missing recommended property: "validFrom"',
                'Missing required property: "url"',
                'Missing recommended property: "availability"',
                'Missing recommended property: "validFrom"',
                'Missing required property: "url"',
                'Missing recommended property: "validFrom"',
                'Missing required property: "url"',
                'Missing recommended property: "validFrom"',
                'The "member" property does not accept the "OrganizationRole" type as a value.',
                'The "alumniOf" property does not accept the "OrganizationRole" type as a value.',
                'The "actor" property does not accept the "PerformanceRole" type as a value.',
                'The "member" property does not accept the "OrganizationRole" type as a value.',
            ],
        ];
    }

    private function provideGoogleFiles(): \Generator
    {
        $path = __DIR__ . '/fixtures/Google';

        // yield 'Article' => [
        //     'document' => $path . '/article.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // // An absolute mess ¯\_(ツ)_/¯
        // yield 'Book' => [
        //     'document' => $path . '/book.jsonld',
        //     'isValid' => false,
        //     'messages' => [
        //         // Weird... The LibrarySystem type definition says URL is required, but the the Google validator does not...
        //         'Missing required property: "url"',
        //     ],
        // ];

        // yield 'Breadcrumb' => [
        //     'document' => $path . '/breadcrumb.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // yield 'Carousel' => [
        //     'document' => $path . '/carousel.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // yield 'Course Info' => [
        //     'document' => $path . '/course-info.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // yield 'Course' => [
        //     'document' => $path . '/course.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // TODO: Currently broken because atLeastOneOf is not handled, should be done.
        // yield 'Covid19' => [
        //     'document' => $path . '/covid19.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        // TODO: Currently broken because atLeastOneOf is not handled, should be done.
        // yield 'Dataset' => [
        //     'document' => $path . '/dataset.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];

        yield 'Tabular Dataset' => [
            'document' => $path . '/dataset-tabular.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        // yield 'Recipe' => [
        //     'document' => $path . '/recipe.jsonld',
        //     'isValid' => true,
        //     'messages' => [],
        // ];
    }
}
