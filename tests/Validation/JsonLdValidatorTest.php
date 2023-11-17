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
use PHPUnit\Framework\ExpectationFailedException;
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

        try {
            $this->assertSame($isValid, !$containsErrors);
        } catch (ExpectationFailedException $exception) {
            $message = sprintf(
                "The validation failed. The following errors were found: \n%s",
                implode(\PHP_EOL, $foundErrorMessages)
            );

            throw new ExpectationFailedException($message, $exception->getComparisonFailure());
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
            'isValid' => false,
            'messages' => [
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "includedInDataCatalog"',
            ],
        ];
        yield 'Complex expanded input' => [
            'document' => $path . '/complex-expanded.jsonld',
            'isValid' => false,
            'messages' => [
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "includedInDataCatalog"',
            ],
        ];
        yield 'Complex flattened input' => [
            'document' => $path . '/complex-flattened.jsonld',
            'isValid' => false,
            'messages' => [
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "distribution"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "funder"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "isAccessibleForFree"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "sameAs"',
                'Missing recommended property: "spatialCoverage"',
                'Missing recommended property: "temporalCoverage"',
                'Missing recommended property: "url"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
                'Missing recommended property: "hasPart"',
                'Missing recommended property: "includedInDataCatalog"',
            ],
        ];
        yield 'Complex framed input' => [
            'document' => $path . '/complex-framed.jsonld',
            'isValid' => false,
            'messages' => [
                'Missing recommended property: "alternateName"',
                'Missing recommended property: "isPartOf"',
                'Missing recommended property: "citation"',
                'Missing recommended property: "measurementTechnique"',
                'Missing recommended property: "variableMeasured"',
                'Missing recommended property: "version"',
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
                'Missing recommended property: "aggregateRating"',
                'Missing recommended property: "department"',
                'Missing recommended property: "geo"',
                'Missing recommended property: "menu"',
                'Missing recommended property: "openingHoursSpecification"',
                'Missing recommended property: "priceRange"',
                'Missing recommended property: "review"',
                'Missing recommended property: "servesCuisine"',
                'Missing recommended property: "url"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "ratingCount"',
                'Missing recommended property: "bestRating"',
                'Missing recommended property: "worstRating"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing recommended property: "name"',
                'Incorrect URL: "wells-fargo-center.html" given.',
                'Missing required property: "itemReviewed"',
                'Missing required property: "ratingCount"',
                'Missing recommended property: "bestRating"',
                'Missing recommended property: "worstRating"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "alternateName"',
                'Missing recommended property: "name"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "alternateName"',
                'Missing recommended property: "name"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "reviewCount"',
                'Missing recommended property: "worstRating"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "ratingCount"',
                'Missing recommended property: "bestRating"',
                'Missing recommended property: "worstRating"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "alternateName"',
                'Missing recommended property: "bestRating"',
                'Missing recommended property: "name"',
                'Missing recommended property: "worstRating"',
                'Missing required property: "itemReviewed"',
                'Missing recommended property: "aggregateRating"',
                'Missing recommended property: "keywords"',
                'Missing recommended property: "recipeCategory"',
                'Missing recommended property: "recipeCuisine"',
                'Missing recommended property: "totalTime"',
                'Missing recommended property: "video"',
                'Incorrect URL: "bananabread.jpg" given.',
                'Missing required property: "name"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "name"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "thumbnailUrl"',
                'Missing required property: "uploadDate"',
                'Missing recommended property: "contentUrl"',
                'Missing recommended property: "embedUrl"',
                'Missing recommended property: "expires"',
                'Missing recommended property: "publication"',
                'Missing recommended property: "regionsAllowed"',
                'Missing required property: "image"',
                'Missing required property: "itemReviewed"',
                'Missing recommended property: "worstRating"',
                'Missing required property: at least one of the following properties must be present "creator, creditText, copyrightNotice, license"',
                'Missing required property: "creator"',
                'Missing required property: "creditText"',
                'Missing required property: "copyrightNotice"',
                'Missing required property: "license"',
                'Missing recommended property: "acquireLicensePage"',
                'Missing recommended property: "copyrightNotice"',
                'Missing recommended property: "creator"',
                'Missing recommended property: "creditText"',
                'Missing recommended property: "license"',
                'Incorrect URL: "mexico-beach.jpg" given.',
                'Missing recommended property: "dateModified"',
                'Missing recommended property: "datePublished"',
                'Missing recommended property: "headline"',
                'Missing recommended property: "image"',
                'Missing required property: "potentialAction"',
                'Missing required property: "hiringOrganization"',
                'Missing recommended property: "applicantLocationRequirements"',
                'Missing recommended property: "directApply"',
                'Missing recommended property: "experienceInPlaceOfEducation"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "jobLocationType"',
                'Missing recommended property: "validThrough"',
                'Missing required property: at least one of the following properties must be present "aggregateRating, review"',
                'Missing required property: "aggregateRating"',
                'Missing required property: "review"',
                'Missing required property: "offers"',
                'Missing recommended property: "applicationCategory"',
                'Missing recommended property: "operatingSystem"',
                'Missing required property: at least one of the following properties must be present "aggregateRating, review"',
                'Missing required property: "aggregateRating"',
                'Missing required property: "review"',
                'Missing required property: "offers"',
                'Missing recommended property: "applicationCategory"',
                'Missing recommended property: "operatingSystem"',
                'Missing required property: "author"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "reviewRating"',
                'Missing recommended property: "datePublished"',
                'Missing required property: at least one of the following properties must be present "creator, creditText, copyrightNotice, license"',
                'Missing required property: "creator"',
                'Missing required property: "creditText"',
                'Missing required property: "copyrightNotice"',
                'Missing required property: "license"',
                'Missing required property: "contentUrl"',
                'Missing recommended property: "acquireLicensePage"',
                'Missing recommended property: "copyrightNotice"',
                'Missing recommended property: "creator"',
                'Missing recommended property: "creditText"',
                'Missing recommended property: "license"',
                'Missing required property: "image"',
                'Missing required property: "image"',
                'Missing required property: at least one of the following properties must be present "creator, creditText, copyrightNotice, license"',
                'Missing required property: "creator"',
                'Missing required property: "creditText"',
                'Missing required property: "copyrightNotice"',
                'Missing required property: "license"',
                'Missing required property: "contentUrl"',
                'Missing recommended property: "acquireLicensePage"',
                'Missing recommended property: "copyrightNotice"',
                'Missing recommended property: "creator"',
                'Missing recommended property: "creditText"',
                'Missing recommended property: "license"',
                'Missing required property: "location"',
                'Missing required property: "startDate"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "offers"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: at least one of the following properties must be present "creator, creditText, copyrightNotice, license"',
                'Missing required property: "creator"',
                'Missing required property: "creditText"',
                'Missing required property: "copyrightNotice"',
                'Missing required property: "license"',
                'Missing required property: "contentUrl"',
                'Missing recommended property: "acquireLicensePage"',
                'Missing recommended property: "copyrightNotice"',
                'Missing recommended property: "creator"',
                'Missing recommended property: "creditText"',
                'Missing recommended property: "license"',
                'Missing required property: "address"',
                'Missing recommended property: "aggregateRating"',
                'Missing recommended property: "department"',
                'Missing recommended property: "geo"',
                'Missing recommended property: "menu"',
                'Missing recommended property: "openingHoursSpecification"',
                'Missing recommended property: "priceRange"',
                'Missing recommended property: "review"',
                'Missing recommended property: "servesCuisine"',
                'Missing recommended property: "telephone"',
                'Missing recommended property: "url"',
                'Missing required property: at least one of the following properties must be present "creator, creditText, copyrightNotice, license"',
                'Missing required property: "creator"',
                'Missing required property: "creditText"',
                'Missing required property: "copyrightNotice"',
                'Missing required property: "license"',
                'Missing required property: "contentUrl"',
                'Missing recommended property: "acquireLicensePage"',
                'Missing recommended property: "copyrightNotice"',
                'Missing recommended property: "creator"',
                'Missing recommended property: "creditText"',
                'Missing recommended property: "license"',
                'Missing required property: "location"',
                'Missing required property: "startDate"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "offers"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "location"',
                'Missing required property: "startDate"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "offers"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "location"',
                'Missing required property: "startDate"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "offers"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "address"',
                'Missing recommended property: "aggregateRating"',
                'Missing recommended property: "department"',
                'Missing recommended property: "geo"',
                'Missing recommended property: "menu"',
                'Missing recommended property: "openingHoursSpecification"',
                'Missing recommended property: "priceRange"',
                'Missing recommended property: "review"',
                'Missing recommended property: "servesCuisine"',
                'Missing recommended property: "telephone"',
                'Missing recommended property: "url"',
                'Missing required property: at least one of the following properties must be present "aggregateRating, review"',
                'Missing required property: "aggregateRating"',
                'Missing required property: "review"',
                'Missing required property: "offers"',
                'Missing recommended property: "applicationCategory"',
                'Missing recommended property: "operatingSystem"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: at least one of the following properties must be present "aggregateRating, review"',
                'Missing required property: "aggregateRating"',
                'Missing required property: "review"',
                'Missing required property: "offers"',
                'Missing recommended property: "applicationCategory"',
                'Missing recommended property: "operatingSystem"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: "image"',
                'Missing required property: "image"',
                'Missing required property: "itemListElement"',
                'Missing required property: "publication"',
                'Missing required property: "name"',
                'Missing required property: "thumbnailUrl"',
                'Missing required property: "uploadDate"',
                'Missing recommended property: "contentUrl"',
                'Missing recommended property: "description"',
                'Missing recommended property: "duration"',
                'Missing recommended property: "embedUrl"',
                'Missing recommended property: "expires"',
                'Missing recommended property: "interactionStatistic"',
                'Missing recommended property: "publication"',
                'Missing recommended property: "regionsAllowed"',
                'Missing required property: "publication"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "url"',
                'Missing recommended property: "availability"',
                'Missing recommended property: "validFrom"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "url"',
                'Missing recommended property: "availability"',
                'Missing recommended property: "validFrom"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "url"',
                'Missing recommended property: "validFrom"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "url"',
                'Missing recommended property: "validFrom"',
                'Missing required property: "itemReviewed"',
                'Missing required property: "ratingCount"',
                'Missing required property: "ratingValue"',
                'Missing recommended property: "bestRating"',
                'Missing recommended property: "worstRating"',
                'Missing recommended property: "description"',
                'Missing recommended property: "endDate"',
                'Missing recommended property: "eventAttendanceMode"',
                'Missing recommended property: "eventStatus"',
                'Missing recommended property: "image"',
                'Missing recommended property: "offers"',
                'Missing recommended property: "organizer"',
                'Missing recommended property: "performer"',
                'Missing recommended property: "previousStartDate"',
                'Missing required property: "itemCondition"',
                'Missing required property: "mileageFromOdometer"',
                'Missing required property: "offers"',
                'Missing required property: "vehicleIdentificationNumber"',
                'Missing required property: "vehicleModelDate"',
                'Missing recommended property: "bodyType"',
                'Missing recommended property: "color"',
                'Missing recommended property: "driveWheelConfiguration"',
                'Missing recommended property: "image"',
                'Missing recommended property: "numberOfDoors"',
                'Missing recommended property: "url"',
                'Missing recommended property: "vehicleEngine"',
                'Missing recommended property: "vehicleInteriorColor"',
                'Missing recommended property: "vehicleInteriorType"',
                'Missing recommended property: "vehicleSeatingCapacity"',
                'Missing recommended property: "vehicleTransmission"',
                'Missing required property: "image"',
                'The "member" property does not accept the "OrganizationRole" type as a value.',
                'The "alumniOf" property does not accept the "OrganizationRole" type as a value.',
                'Missing required property: "image"',
                'The "actor" property does not accept the "PerformanceRole" type as a value.',
                'The "member" property does not accept the "OrganizationRole" type as a value.',
                'Missing required property: "datePosted"',
                'Missing required property: "description"',
                'Missing required property: "hiringOrganization"',
                'Missing required property: "jobLocation"',
                'Missing recommended property: "applicantLocationRequirements"',
                'Missing recommended property: "baseSalary"',
                'Missing recommended property: "directApply"',
                'Missing recommended property: "educationRequirements"',
                'Missing recommended property: "employmentType"',
                'Missing recommended property: "experienceInPlaceOfEducation"',
                'Missing recommended property: "experienceRequirements"',
                'Missing recommended property: "identifier"',
                'Missing recommended property: "jobLocationType"',
                'Missing recommended property: "validThrough"',
            ],
        ];
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
