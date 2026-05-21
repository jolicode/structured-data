<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation\Benchmark;

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Extraction\JsonLdElement;
use Jolicode\JsonLd\Extraction\JsonLdNodeExtractor;
use Jolicode\JsonLd\Extraction\MicrodataExtractor;
use Jolicode\JsonLd\Extraction\RdfaExtractor;
use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Mapper\ValidationMapper;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\AbstractValidator;
use Jolicode\Vocabularies\Validators\RegisteredValidatorsContainer;

class HtmlValidationPipelineBench
{
    private const FIXTURES_BASE_DIR = __DIR__ . '/../fixtures';

    private const SCENARIO_HOMEPAGE = 'homepage';

    private const SCENARIO_HEAVY = 'heavy';

    private const SCENARIO_LISTING = 'listing';

    /** @var array<string, string> */
    private array $documents;

    /** @var array<string, list<JsonLdElement>> */
    private array $elementsByScenario = [];

    /** @var array<string, list<array{expanded: array, parsed: ObjectStructure, sourceFormat: string}>> */
    private array $validationJobsByScenario = [];

    /** @var list<MappedType> */
    private array $mappedTypesForValidation = [];

    /** @var array<string, AbstractValidator> */
    private array $validators;

    public function __construct(
        private readonly Validator $validator = new Validator(),
        private readonly Extractor $extractor = new Extractor(),
        private readonly JsonLdNodeExtractor $jsonLdExtractor = new JsonLdNodeExtractor(),
        private readonly RdfaExtractor $rdfaExtractor = new RdfaExtractor(),
        private readonly MicrodataExtractor $microdataExtractor = new MicrodataExtractor(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly RegisteredValidatorsContainer $validatorsContainer = new RegisteredValidatorsContainer(),
        private readonly Expander $expander = new Expander(),
    ) {
        $this->documents = [
            self::SCENARIO_HOMEPAGE => $this->loadFixture('benchmark/homepage-sample.html'),
            self::SCENARIO_HEAVY => $this->loadFixture('benchmark/jolicampus-formations-symfony.html'),
            self::SCENARIO_LISTING => $this->loadFixture('benchmark/listing-sample.html'),
        ];

        $this->validators = $this->validatorsContainer->getValidators();

        foreach (array_keys($this->documents) as $scenario) {
            $elements = array_values($this->extractor->extract($this->documents[$scenario]));
            $this->elementsByScenario[$scenario] = $elements;
            $this->validationJobsByScenario[$scenario] = $this->buildValidationJobs($elements);
        }
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageGuessFormatJsonld(): void
    {
        $this->jsonLdExtractor->supportsContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseGuessFormatJsonld(): void
    {
        $this->jsonLdExtractor->supportsContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingGuessFormatJsonld(): void
    {
        $this->jsonLdExtractor->supportsContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageGuessFormatRdfa(): void
    {
        $this->rdfaExtractor->supportsContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseGuessFormatRdfa(): void
    {
        $this->rdfaExtractor->supportsContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingGuessFormatRdfa(): void
    {
        $this->rdfaExtractor->supportsContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageGuessFormatMicrodata(): void
    {
        $this->microdataExtractor->supportsContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseGuessFormatMicrodata(): void
    {
        $this->microdataExtractor->supportsContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingGuessFormatMicrodata(): void
    {
        $this->microdataExtractor->supportsContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageExtractDocumentJsonld(): void
    {
        $this->jsonLdExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseExtractDocumentJsonld(): void
    {
        $this->jsonLdExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingExtractDocumentJsonld(): void
    {
        $this->jsonLdExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageExtractDocumentRdfa(): void
    {
        $this->rdfaExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseExtractDocumentRdfa(): void
    {
        $this->rdfaExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingExtractDocumentRdfa(): void
    {
        $this->rdfaExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(10)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageExtractDocumentMicrodata(): void
    {
        $this->microdataExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseExtractDocumentMicrodata(): void
    {
        $this->microdataExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingExtractDocumentMicrodata(): void
    {
        $this->microdataExtractor->extractStructuredDataContent($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageFullExtractionProcess(): void
    {
        $this->extractor->extract($this->documents[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseFullExtractionProcess(): void
    {
        $this->extractor->extract($this->documents[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(1)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingFullExtractionProcess(): void
    {
        $this->extractor->extract($this->documents[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageParseDocument(): void
    {
        foreach ($this->elementsByScenario[self::SCENARIO_HOMEPAGE] as $element) {
            $this->parser->parse($element);
        }
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseParseDocument(): void
    {
        foreach ($this->elementsByScenario[self::SCENARIO_HEAVY] as $element) {
            $this->parser->parse($element);
        }
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingParseDocument(): void
    {
        foreach ($this->elementsByScenario[self::SCENARIO_LISTING] as $element) {
            $this->parser->parse($element);
        }
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageMapParsedDocument(): void
    {
        $this->runMappingJobs($this->validationJobsByScenario[self::SCENARIO_HOMEPAGE]);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseMapParsedDocument(): void
    {
        $this->runMappingJobs($this->validationJobsByScenario[self::SCENARIO_HEAVY]);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingMapParsedDocument(): void
    {
        $this->runMappingJobs($this->validationJobsByScenario[self::SCENARIO_LISTING]);
    }

    /**
     * @Revs(5)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     *
     * @BeforeMethods({"prepareHomepageMappedTypes"})
     */
    public function benchHtmlHomepageValidateParsedDocument(): void
    {
        $this->validateMappedTypes($this->mappedTypesForValidation);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     *
     * @BeforeMethods({"prepareHeavyCourseMappedTypes"})
     */
    public function benchHtmlHeavyCourseValidateParsedDocument(): void
    {
        $this->validateMappedTypes($this->mappedTypesForValidation);
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     *
     * @BeforeMethods({"prepareBlogListingMappedTypes"})
     */
    public function benchHtmlBlogListingValidateParsedDocument(): void
    {
        $this->validateMappedTypes($this->mappedTypesForValidation);
    }

    /**
     * @Revs(3)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHomepageFullProcess(): void
    {
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/homepage-sample.html');
    }

    /**
     * @Revs(2)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlHeavyCourseFullProcess(): void
    {
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/jolicampus-formations-symfony.html');
    }

    /**
     * @Revs(1)
     *
     * @Iterations(3)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHtmlBlogListingFullProcess(): void
    {
        $this->validator->audit(self::FIXTURES_BASE_DIR . '/benchmark/listing-sample.html');
    }

    /** @noinspection PhpUnused */
    public function prepareHomepageMappedTypes(): void
    {
        $this->prepareMappedTypesForValidation(self::SCENARIO_HOMEPAGE);
    }

    /** @noinspection PhpUnused */
    public function prepareHeavyCourseMappedTypes(): void
    {
        $this->prepareMappedTypesForValidation(self::SCENARIO_HEAVY);
    }

    /** @noinspection PhpUnused */
    public function prepareBlogListingMappedTypes(): void
    {
        $this->prepareMappedTypesForValidation(self::SCENARIO_LISTING);
    }

    private function loadFixture(string $relativePath): string
    {
        $fullPath = self::FIXTURES_BASE_DIR . '/' . $relativePath;
        $document = file_get_contents($fullPath);

        if (false === $document) {
            throw new \RuntimeException(\sprintf('Could not load benchmark fixture "%s".', $fullPath));
        }

        return $document;
    }

    /**
     * @param list<JsonLdElement> $elements
     *
     * @return list<array{expanded: array, parsed: ObjectStructure, sourceFormat: string}>
     */
    private function buildValidationJobs(array $elements): array
    {
        $jobs = [];

        foreach ($elements as $element) {
            $parsed = $this->parser->parse($element);
            $expanded = $this->expander->expand($element->content, encodeResult: false);

            if (!\is_array($expanded)) {
                continue;
            }

            if ($parsed instanceof ArrayStructure) {
                foreach ($parsed->getValues() as $index => $jsonLdNode) {
                    $expandedNode = $expanded[$index] ?? null;

                    if (!$expandedNode instanceof \stdClass) {
                        continue;
                    }

                    /** @var ObjectStructure $objectStructure */
                    $objectStructure = $jsonLdNode->content;
                    $jobs[] = [
                        'expanded' => [$expandedNode],
                        'parsed' => $objectStructure,
                        'sourceFormat' => $element->sourceFormat->value,
                    ];
                }

                continue;
            }

            if (!$parsed instanceof ObjectStructure) {
                continue;
            }

            $jobs[] = [
                'expanded' => $expanded,
                'parsed' => $parsed,
                'sourceFormat' => $element->sourceFormat->value,
            ];
        }

        return $jobs;
    }

    /**
     * @param list<array{expanded: array, parsed: ObjectStructure, sourceFormat: string}> $jobs
     */
    private function runMappingJobs(array $jobs): array
    {
        $mappedTypes = [];

        foreach ($jobs as $job) {
            $this->validationMapper->reset();

            foreach ($this->validationMapper->map($job['expanded'], $job['parsed'], $job['sourceFormat']) as $type) {
                $mappedTypes[] = $type;
            }
        }

        return $mappedTypes;
    }

    private function prepareMappedTypesForValidation(string $scenario): void
    {
        $this->mappedTypesForValidation = array_values($this->runMappingJobs($this->validationJobsByScenario[$scenario]));
    }

    /**
     * @param list<MappedType> $types
     */
    private function validateMappedTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->validateType($type);
        }
    }

    private function validateType(MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        if (IriResolver::isAbsoluteIri($type->getType())) {
            return;
        }

        $this->callValidatorsForType($type);

        foreach ($type->getProperties() as $property) {
            if ($property->getValue() instanceof MappedType) {
                $this->validateType($property->getValue());

                if (!$property->getValue()->isValid()) {
                    $type->setIsValid(false);
                    $property->setIsValid(false);
                }
            }

            if (\is_array($property->getValue())) {
                foreach ($property->getValue() as $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        $this->validateType($multipleTypesEntry);

                        if (!$multipleTypesEntry->isValid()) {
                            $type->setIsValid(false);
                            $property->setIsValid(false);
                        }
                    }
                }
            }

            $this->callValidatorsForProperty($property, $type, $originalProperty);
        }
    }

    private function callValidatorsForType(MappedType $type): void
    {
        if ($this->isTypeReference($type)) {
            return;
        }

        foreach ($this->validators as $validator) {
            $validator->validateType($type);
        }
    }

    private function callValidatorsForProperty(MappedProperty $property, MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        if (Keyword::tryFrom($property->getKey())) {
            return;
        }

        foreach ($this->validators as $validator) {
            $validator->validateProperty($type, $property, $originalProperty);
        }
    }

    private function isTypeReference(MappedType $type): bool
    {
        $properties = $type->getProperties();

        return \array_key_exists(Keyword::ID->value, $properties)
            && IriResolver::isBlankNodeIdentifier($properties[Keyword::ID->value]->getValue())
            && 1 === \count($properties);
    }
}
