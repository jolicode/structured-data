<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Mapper\ValidationMapper;
use Jolicode\Vocabularies\Validators\RegisteredValidatorsContainer;
use JsonStreamingParser\Exception\ParsingException;

class Validator
{
    private array $currentValidators = [];

    public function __construct(
        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly RegisteredValidatorsContainer $validatorsContainer = new RegisteredValidatorsContainer(),
        private readonly Extractor $extractor = new Extractor(),
    ) {
        $this->resetValidators();
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

        $this->currentValidators = [$this->validatorsContainer->getValidator($validator)];
    }

    /**
     * Returns false if the provided document contains schema.org errors, true otherwise.
     */
    public function isValid(string $input): bool
    {
        foreach ($this->getTypes($input) as $type) {
            if ($type->errors) {
                return false;
            }
        }

        return true;
    }

    /**
     * This method returns the tree of the schema.org types found in the
     * provided document, along with their properties and errors.
     *
     * If required, tt will make HTTP requests.
     *
     * @return array<MappedType>
     */
    public function getTypes(string $input): array
    {
        $this->validationMapper->reset();

        if (!$this->currentValidators) {
            $this->resetValidators();
        }

        try {
            $elements = $this->extractor->extract($input);
        } catch (\RuntimeException $exception) {
            if (str_starts_with($exception->getMessage(), Extractor::NO_SUPPORTED_FORMATS_DETECTED_MESSAGE_PREFIX)) {
                return [];
            }

            return $this->createInvalidDocumentType($exception->getMessage(), 0);
        }

        $expander = new Expander();
        $types = [];

        if (!\count($elements)) {
            return [];
        }

        foreach ($elements as $jsonLdElement) {
            try {
                /**
                 * @var ArrayStructure|ObjectStructure $parsedJsonLd
                 */
                $parsedJsonLd = $this->parser->parse($jsonLdElement);
            } catch (ParsingException $exception) {
                return $this->createInvalidDocumentType($exception->getMessage(), $jsonLdElement->startLine);
            }

            try {
                $expansionResult = $expander->expand($jsonLdElement->content, encodeResult: false);
            } catch (JsonLdException $exception) {
                return $this->createInvalidDocumentType($exception->getMessage(), $jsonLdElement->startLine);
            }

            if (!\is_array($expansionResult)) {
                return $this->createInvalidDocumentType('The JSON-LD document is not valid', $jsonLdElement->startLine);
            }

            if ($parsedJsonLd instanceof ArrayStructure) {
                foreach ($parsedJsonLd->getValues() as $index => $jsonLdNode) {
                    /**
                     * @var ObjectStructure $objectStructure
                     */
                    $objectStructure = $jsonLdNode->content;

                    $types = [...$types, ...$this->validateJsonLdElement([$expansionResult[$index]], $objectStructure)];
                }
            } else {
                $types = [...$types, ...$this->validateJsonLdElement($expansionResult, $parsedJsonLd)];
            }
        }

        $extractionWarnings = $this->extractor->getLastExtractionWarnings();

        if ($extractionWarnings && $types) {
            $firstType = $types[array_key_first($types)];

            foreach ($extractionWarnings as $warning) {
                $firstType->warnings[] = new MappedError(
                    \sprintf(
                        'A %s snippet was detected but is malformed and could not be fully processed. Reason: %s',
                        $warning->format,
                        $warning->message,
                    ),
                    null,
                    null,
                    MappedError::SEVERITY_WARNING,
                    null,
                    '',
                );
            }
        }

        return [...$types];
    }

    /**
     * @return array<MappedType>
     */
    private function validateJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd): array
    {
        $this->validationMapper->reset();

        $types = $this->validationMapper->map($expandedJsonLd, $parsedJsonLd);

        foreach ($types as $type) {
            $this->validateType($type);
        }

        return $types;
    }

    /**
     * @return array<MappedType>
     */
    private function createInvalidDocumentType(string $message, int $startLine): array
    {
        $error = new MappedError(
            $message,
            null,
            null,
            MappedError::SEVERITY_ERROR,
            null,
            \sprintf('line %d', $startLine),
        );

        return [new MappedType(
            isValid: false,
            errorSeverity: MappedError::SEVERITY_ERROR,
            errors: [$error],
        )];
    }

    /**
     * This method will iterate over each type of a property and validate them.
     * A type may contain other types as property values, so it will recursively call itself if some are found.
     */
    private function validateType(MappedType $type, ?MappedProperty $originalProperty = null): void
    {
        if (IriResolver::isAbsoluteIri($type->type)) {
            return;
        }

        $this->callValidatorsForType($type, $originalProperty);

        /**
         * @var MappedProperty $property
         */
        foreach ($type->properties as $property) {
            if ($property->value instanceof MappedType) {
                $this->validateType($property->value);

                if (!$property->value->isValid) {
                    $type->isValid = false;
                    $property->isValid = false;
                }
            }

            if (\is_array($property->value)) {
                foreach ($property->value as $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        $this->validateType($multipleTypesEntry);

                        if (!$multipleTypesEntry->isValid) {
                            $type->isValid = false;
                            $property->isValid = false;
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
        if (Keyword::tryFrom($property->key)) {
            return;
        }

        foreach ($this->currentValidators as $validator) {
            $validator->validateProperty($type, $property, $originalProperty);
        }
    }

    private function isTypeReference(MappedType $type): bool
    {
        $properties = $type->properties;

        return \array_key_exists(Keyword::ID->value, $type->properties)
            && IriResolver::isBlankNodeIdentifier($properties[Keyword::ID->value]->value)
            && 1 === \count($properties);
    }
}
