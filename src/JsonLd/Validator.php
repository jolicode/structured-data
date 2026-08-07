<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Audit\Audit;
use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Extraction\ExtractorFormat;
use Jolicode\JsonLd\Extraction\JsonLdElement;
use Jolicode\JsonLd\Mapper\DocumentError;
use Jolicode\JsonLd\Mapper\DocumentIssueInterface;
use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Mapper\ValidationMapper;
use Jolicode\JsonLd\Mapper\ValidationSnippetCache;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\Vocabularies\Validators\RegisteredValidatorsContainer;
use JsonStreamingParser\Exception\ParsingException;

class Validator
{
    /**
     * Maximum number of extracted documents kept in memory. The cache is keyed by
     * the document itself, so without a bound a long-lived process auditing many
     * distinct documents would grow indefinitely.
     */
    private const EXTRACTED_ELEMENTS_CACHE_MAX_ENTRIES = 32;

    /**
     * @var array<string, array{elements: array<JsonLdElement>, documentIssues: array<DocumentIssueInterface>}>
     */
    private array $extractedElementsCache = [];

    private array $currentValidators = [];

    private readonly Expander $expander;

    /**
     * @param DocumentLoaderInterface|null $documentLoader how the "@context" URLs found
     *                                                     in the audited documents may be
     *                                                     resolved. Defaults to a loader
     *                                                     that refuses every host, so no
     *                                                     request ever leaves the process.
     *                                                     See the "Loading remote contexts"
     *                                                     section of the README.
     */
    public function __construct(
        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly RegisteredValidatorsContainer $validatorsContainer = new RegisteredValidatorsContainer(),
        private readonly Extractor $extractor = new Extractor(),
        ?Expander $expander = null,
        private readonly ValidationSnippetCache $snippetCache = new ValidationSnippetCache(),
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $this->expander = $expander ?? new Expander(documentLoader: $documentLoader);
    }

    public function resetValidators(): void
    {
        $this->currentValidators = $this->validatorsContainer->getValidators();
    }

    public function setValidator(string $validator): void
    {
        if (class_exists($validator)) {
            $this->currentValidators = [$this->validatorsContainer->getValidator($validator)];

            return;
        }

        $validator = $this->validatorsContainer->getValidatorClassName($validator);

        if (false === $validator) {
            throw new \InvalidArgumentException('Unknown validator.');
        }

        $this->currentValidators = [$this->validatorsContainer->getValidator($validator)];
    }

    /**
     * This method returns an audit report for the schema.org types found in the
     * provided document, along with their properties, errors, and warnings.
     *
     * The $document argument is the document itself, not a URL nor a file path:
     * this library never guesses what an input is, and never fetches it for you.
     * Deciding what may be fetched, and under which restrictions, belongs to the
     * application - see the "Accepted inputs" section of the README.
     */
    public function audit(string $document): Audit
    {
        $this->validationMapper->reset();

        if (!$this->currentValidators) {
            $this->resetValidators();
        }

        $extractCacheKey = $document;
        $documentIssues = [];

        if (isset($this->extractedElementsCache[$extractCacheKey])) {
            $elements = $this->extractedElementsCache[$extractCacheKey]['elements'];
            $documentIssues = $this->extractedElementsCache[$extractCacheKey]['documentIssues'];
        } else {
            try {
                $elements = $this->extractor->extract($document);
                $documentIssues = $this->extractor->getDocumentIssues();
            } catch (\RuntimeException $exception) {
                return $this->createInvalidDocumentAudit($exception->getMessage(), 0, 'extractor');
            }

            if (\count($elements)) {
                $this->extractedElementsCache[$extractCacheKey] = [
                    'elements' => $elements,
                    'documentIssues' => $documentIssues,
                ];

                while (\count($this->extractedElementsCache) > self::EXTRACTED_ELEMENTS_CACHE_MAX_ENTRIES) {
                    unset($this->extractedElementsCache[array_key_first($this->extractedElementsCache)]);
                }
            }
        }

        if (!\count($elements)) {
            return $this->createInvalidDocumentAudit('No structured data elements could be extracted from the provided document.', 0, 'extractor');
        }

        $types = [];

        foreach ($elements as $jsonLdElement) {
            try {
                /**
                 * @var ArrayStructure|ObjectStructure $parsedJsonLd
                 */
                $parsedJsonLd = $this->parser->parse($jsonLdElement);
            } catch (ParsingException $exception) {
                return $this->createInvalidDocumentAudit($exception->getMessage(), $jsonLdElement->startLine, 'json');
            }

            $validatedTypeTemplatesByElement = null;
            $cacheKey = $this->snippetCache->getKey($jsonLdElement, $this->currentValidators);
            $cacheEntry = $this->snippetCache->get($cacheKey);

            if (null !== $cacheEntry) {
                $expansionResult = $cacheEntry['expandedJsonLd'];
                $validatedTypeTemplatesByElement = $cacheEntry['validatedTypesByElement'];
            } else {
                try {
                    $expansionResult = $this->expander->expand($jsonLdElement->content, encodeResult: false);
                } catch (JsonLdException $exception) {
                    return $this->createInvalidDocumentAudit($exception->getMessage(), $jsonLdElement->startLine, 'expander');
                }
            }

            if (!\is_array($expansionResult)) {
                return $this->createInvalidDocumentAudit('The JSON-LD document is not valid', $jsonLdElement->startLine, 'expander');
            }

            if ($parsedJsonLd instanceof ArrayStructure) {
                $validatedTypesByElement = [];

                foreach ($parsedJsonLd->getValues() as $index => $jsonLdNode) {
                    /**
                     * @var ObjectStructure $objectStructure
                     */
                    $objectStructure = $jsonLdNode->content;

                    if (null !== $validatedTypeTemplatesByElement) {
                        $validatedTypes = $this->mapJsonLdElement([$expansionResult[$index]], $objectStructure, $jsonLdElement->sourceFormat);
                        $this->snippetCache->applyValidatedTypeTemplates($validatedTypes, $validatedTypeTemplatesByElement[$index] ?? []);
                    } else {
                        $validatedTypes = $this->validateJsonLdElement([$expansionResult[$index]], $objectStructure, $jsonLdElement->sourceFormat);
                        $validatedTypesByElement[$index] = $this->snippetCache->buildValidatedTypeTemplates($validatedTypes);
                    }

                    foreach ($validatedTypes as $validatedType) {
                        $types[] = $validatedType;
                    }
                }

                if (null === $validatedTypeTemplatesByElement) {
                    $this->snippetCache->store($cacheKey, $expansionResult, $validatedTypesByElement);
                }
            } else {
                if (null !== $validatedTypeTemplatesByElement) {
                    $validatedTypes = $this->mapJsonLdElement($expansionResult, $parsedJsonLd, $jsonLdElement->sourceFormat);
                    $this->snippetCache->applyValidatedTypeTemplates($validatedTypes, $validatedTypeTemplatesByElement[0] ?? []);
                } else {
                    $validatedTypes = $this->validateJsonLdElement($expansionResult, $parsedJsonLd, $jsonLdElement->sourceFormat);

                    $this->snippetCache->store($cacheKey, $expansionResult, [0 => $this->snippetCache->buildValidatedTypeTemplates($validatedTypes)]);
                }

                foreach ($validatedTypes as $validatedType) {
                    $types[] = $validatedType;
                }
            }
        }

        $documentIssues = $this->mapDocumentIssuesToMappedErrors($documentIssues);

        return new Audit($types, $documentIssues);
    }

    /**
     * @return array<MappedType>
     */
    private function validateJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd, ExtractorFormat $sourceFormat): array
    {
        $types = $this->mapJsonLdElement($expandedJsonLd, $parsedJsonLd, $sourceFormat);

        foreach ($types as $type) {
            $this->validateType($type);
        }

        return $types;
    }

    /**
     * @return array<MappedType>
     */
    private function mapJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd, ExtractorFormat $sourceFormat): array
    {
        $this->validationMapper->reset();

        return $this->validationMapper->map($expandedJsonLd, $parsedJsonLd, $sourceFormat->value);
    }

    private function createInvalidDocumentAudit(string $message, int $startLine, string $source): Audit
    {
        $documentError = new DocumentError(
            source: ucfirst($source),
            message: $message,
            ranges: \sprintf('line %d', $startLine),
        );

        return new Audit([], $this->mapDocumentIssuesToMappedErrors([$documentError]));
    }

    /**
     * @param array<DocumentIssueInterface> $issues
     *
     * @return array<MappedError>
     */
    private function mapDocumentIssuesToMappedErrors(array $issues): array
    {
        $mappedErrors = [];

        foreach ($issues as $issue) {
            $isError = $issue instanceof DocumentError;
            $severity = $isError ? MappedError::SEVERITY_ERROR : MappedError::SEVERITY_WARNING;

            $mappedErrors[] = new MappedError(
                message: $issue->getMessage(),
                property: null,
                type: null,
                severity: $severity,
                validatorName: $issue->getSource(),
                ranges: $issue->getRanges(),
            );
        }

        return $mappedErrors;
    }

    /**
     * This method will iterate over each type of a property and validate them.
     * A type may contain other types as property values, so it will recursively call itself if some are found.
     */
    private function validateType(MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        if (IriResolver::isAbsoluteIri($type->getType())) {
            return;
        }

        $this->callValidatorsForType($type);

        /**
         * @var MappedProperty $property
         */
        foreach ($type->getProperties() as $property) {
            $propertyValue = $property->getValue();

            if ($propertyValue instanceof MappedType) {
                $this->validateType($propertyValue);

                if (!$propertyValue->isValid()) {
                    $type->setIsValid(false);
                    $property->setIsValid(false);
                }
            } elseif (\is_array($propertyValue)) {
                foreach ($propertyValue as $multipleTypesEntry) {
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

        foreach ($this->currentValidators as $validator) {
            $validator->validateType($type);
        }
    }

    private function callValidatorsForProperty(MappedProperty $property, MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        $propertyKey = $property->getKey();

        if ('@' === ($propertyKey[0] ?? '') && Keyword::tryFrom($propertyKey)) {
            return;
        }

        foreach ($this->currentValidators as $validator) {
            $validator->validateProperty($type, $property, $originalProperty);
        }
    }

    private function isTypeReference(MappedType $type): bool
    {
        $properties = $type->getProperties();

        return 1 === \count($properties)
            && Keyword::ID->value === array_key_first($properties)
            && IriResolver::isBlankNodeIdentifier($properties[Keyword::ID->value]->getValue());
    }
}
