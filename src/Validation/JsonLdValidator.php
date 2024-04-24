<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\JsonLd\Validation\Extraction\AbstractElement;
use Jolicode\JsonLd\Validation\Extraction\JsonLdNodeExtractor;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Mapper\ValidationMapper;
use Jolicode\JsonLd\Validation\Validators\Google\GoogleValidator;
use Jolicode\JsonLd\Validation\Validators\RegisteredValidatorsContainer;
use Jolicode\JsonLd\Validation\Validators\SchemaOrg\SchemaOrgValidator;
use JsonStreamingParser\Exception\ParsingException;

class JsonLdValidator
{
    public function __construct(
        /**
         * @var array<string, string|array<string>>
         */
        private array $typesStack = [],
        private ?string $specificValidator = null,
        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly RegisteredValidatorsContainer $container = new RegisteredValidatorsContainer(),
        private readonly JsonLdNodeExtractor $extractor = new JsonLdNodeExtractor(),
    ) {
    }

    public function getSupportedValidatorsSimpleNames(): array
    {
        $supportedValidators = array_map(
            fn (string $validatorFqcn) => strtolower($validatorFqcn::VALIDATOR_NAME),
            array_keys($this->container->getValidators()),
        );

        return $supportedValidators;
    }

    public function getValidatorClassName(string $validatorCasualName): false|string
    {
        return match (strtolower($validatorCasualName)) {
            'schemaorg' => SchemaOrgValidator::class,
            'schema.org' => SchemaOrgValidator::class,
            'google' => GoogleValidator::class,
            default => false,
        };
    }

    /**
     * This method is the main entrypoint of the library.
     * It will make HTTP requests if needed, extract the JsonLd from the document, and validate it.
     * It will merge all types found in the document (either in distinct <script> tags or in an array of types) in an array of MappedTypes.
     *
     * @return array<MappedType|MappedError>
     */
    public function validate(string $input, ?string $specificValidator = null): array
    {
        $this->reset();
        $this->specificValidator = $specificValidator;

        $elements = $this->getJsonLdContent($input);
        $expander = new Expander();
        $types = [];

        if (!\count($elements)) {
            return $this->createInvalidDocumentType('No JSON-LD elements were found in this document', 0);
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
                $expansionResult = $expander->parseJson($jsonLdElement->content, encodeResult: false);
            } catch (JsonLdException $exception) {
                return $this->createInvalidDocumentType($exception->getMessage(), $jsonLdElement->startLine);
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
                $types = $this->validateJsonLdElement($expansionResult, $parsedJsonLd);
            }
        }

        return [...$types];
    }

    /**
     * @return array<AbstractElement>
     */
    private function getJsonLdContent(string $input): array
    {
        if (IriResolver::isAbsoluteIri($input)) {
            return $this->extractor->extractJsonLd($input);
        }

        if (is_file($input)) {
            $input = file_get_contents($input);
        }

        return $this->extractor->extractStructuredDataContent($input);
    }

    /**
     * @return array<MappedType>
     */
    private function validateJsonLdElement(array $expandedJsonLd, ObjectStructure $parsedJsonLd): array
    {
        $this->reset();

        $types = $this->validationMapper->map($expandedJsonLd, $parsedJsonLd);

        foreach ($types as $type) {
            $this->validateType($type);
        }

        return $types;
    }

    private function reset(): void
    {
        $this->typesStack = [];
        $this->validationMapper->reset();
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
            sprintf('line %d', $startLine),
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
                $this->validateType($property->value, $property);

                if (!$property->value->isValid) {
                    $type->isValid = false;
                    $property->isValid = false;
                }
            }

            if (\is_array($property->value)) {
                foreach ($property->value as $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        $this->validateType($multipleTypesEntry, $property);

                        if (!$multipleTypesEntry->isValid) {
                            $type->isValid = false;
                            $property->isValid = false;
                        }
                    }
                }
            }

            $this->callValidatorsForProperty($property, $type);
        }
    }

    private function callValidatorsForType(MappedType $type, ?MappedProperty $property): void
    {
        if ($this->isTypeReference($type)) {
            return;
        }

        $validators = $this->specificValidator
            ? [$this->container->getValidator($this->specificValidator)]
            : $this->container->getValidators();

        foreach ($validators as $validator) {
            $validator::validateType($type, $property, $this->typesStack);
        }
    }

    private function callValidatorsForProperty(MappedProperty $property, MappedType $type): void
    {
        if (Keyword::tryFrom($property->key)) {
            return;
        }

        $validators = $this->specificValidator
            ? [$this->container->getValidator($this->specificValidator)]
            : $this->container->getValidators();

        foreach ($validators as $validator) {
            $validator::validateProperty($type, $property, $this->typesStack);
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
