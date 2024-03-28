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
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
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
     * This method takes a raw JSON-LD string and will validate it.
     * It will return a ValidationMap object, containing the validation errors found with their location in the JSON-LD document.
     * The map also contains a user friendly tree of all the types found in the JSON-LD document, used for frontend and API purposes.
     *
     * @return array<ValidationMap>
     */
    public function validate(string $jsonLd, ?string $specificValidator = null): array
    {
        $this->reset();

        $this->specificValidator = $specificValidator;

        try {
            /**
             * @var ArrayStructure|ObjectStructure $parsedJsonLd
             */
            $parsedJsonLd = $this->parser->parse($jsonLd);
        } catch (ParsingException $exception) {
            return [$this->createMapWithInvalidDocument($exception->getMessage())];
        }

        $expander = new Expander();

        try {
            $expansionResult = $expander->parseJson($jsonLd, encodeResult: false);
        } catch (JsonLdException $exception) {
            return [$this->createMapWithInvalidDocument($exception->getMessage())];
        }

        $maps = [];

        if ($parsedJsonLd instanceof ArrayStructure) {
            foreach ($parsedJsonLd->getValues() as $index => $jsonLdNode) {
                /**
                 * @var ObjectStructure $objectStructure
                 */
                $objectStructure = $jsonLdNode->content;

                $maps[] = $this->createValidationMap([$expansionResult[$index]], $objectStructure);
            }
        } else {
            $maps[] = $this->createValidationMap($expansionResult, $parsedJsonLd);
        }

        return $maps;
    }

    private function createValidationMap(array $expandedJsonLd, ObjectStructure $parsedJsonLd): ValidationMap
    {
        $this->reset();

        $map = $this->validationMapper->map($expandedJsonLd, $parsedJsonLd);

        foreach ($map->getTypes() as $type) {
            $this->validateType($type);
        }

        return $this->validationMapper->getMap();
    }

    private function reset(): void
    {
        $this->typesStack = [];
        $this->validationMapper->reset();
    }

    private function createMapWithInvalidDocument(string $message): ValidationMap
    {
        $error = new MappedError(
            $message,
            null,
            null,
            MappedError::SEVERITY_ERROR,
            null,
            'line 1, column 1',
        );

        return new ValidationMap([$error], []);
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

                continue;
            }

            if (\is_array($property->value)) {
                foreach ($property->value as $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        $this->validateType($multipleTypesEntry, $property);
                    }
                }

                continue;
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
            $errors = $validator::validateType($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $this->addMappedError($type, $message, $type, $severity, $validator::VALIDATOR_NAME);
            }
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
            $errors = $validator::validateProperty($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $this->addMappedError($type, $message, $type, $severity, $validator::VALIDATOR_NAME);
            }
        }
    }

    private function isTypeReference(MappedType $type): bool
    {
        $properties = $type->properties;

        return \array_key_exists(Keyword::ID->value, $type->properties)
            && IriResolver::isBlankNodeIdentifier($properties[Keyword::ID->value]->value)
            && 1 === \count($properties);
    }

    private function addMappedError(MappedType|MappedProperty $target, string $message, MappedType $typeWithError, string $severity, string $validatorName): void
    {
        $typeLabel = $typeWithError->type;

        if (\is_array($typeLabel)) {
            $typeLabel = sprintf(
                '[%s]',
                implode(', ', $typeLabel),
            );
        }

        $range = array_map(
            fn (Range $range) => sprintf(
                'starting line %d, column %d and ending line %d, column %d',
                $range->start->line,
                $range->start->column,
                $range->end->line,
                $range->end->column,
            ),
            $target->getRanges(),
        );

        $range = implode(\PHP_EOL, $range);

        $error = new MappedError(
            $message,
            Keyword::TYPE->value,
            $typeLabel,
            $severity,
            $validatorName,
            $range,
        );

        $target->errors[] = $error;
        $this->validationMapper->getMap()->addError($error);
    }
}
