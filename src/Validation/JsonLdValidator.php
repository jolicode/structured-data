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
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\JsonLd\Parser\Position;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Validation\Error\RegularPropertyValidationError;
use Jolicode\JsonLd\Validation\Error\TypePropertyValidationError;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
use Jolicode\JsonLd\Validation\Mapper\ValidationMapper;
use Jolicode\JsonLd\Validation\Validators\RegisteredValidatorsContainer;
use Jolicode\JsonLd\Validation\Validators\SchemaOrg\SchemaOrgValidator;
use JsonStreamingParser\Exception\ParsingException;

class JsonLdValidator
{
    public function __construct(
        private bool $hasAGraph = false,

        private int $graphKey = 0,

        /**
         * @var string[]
         */
        private array $typesStack = [],

        /**
         * @var array<string,ValidationError>
         */
        private array $validationErrors = [],

        private readonly ValidationMapper $validationMapper = new ValidationMapper(),
        private readonly JsonLdParser $parser = new JsonLdParser(),
        private readonly RegisteredValidatorsContainer $container = new RegisteredValidatorsContainer(),
    ) {
    }

    /**
     * This method takes a raw JSON-LD string and will validate it.
     * It will return a ValidationMap object, containing the validation errors found with their location in the JSON-LD document.
     * The map also contains a user friendly tree of all the types found in the JSON-LD document, used for frontend and API purposes.
     */
    public function validate(string $jsonLd): ValidationMap
    {
        $this->reset();

        try {
            $parsedJsonLd = $this->parser->parse($jsonLd);
        } catch (ParsingException $exception) {
            return $this->createMapWithInvalidDocument($exception->getMessage());
        }

        $expander = new Expander();

        try {
            $expansionResult = $expander->parseJson($jsonLd, encodeResult: false);
        } catch (JsonLdException $exception) {
            return $this->createMapWithInvalidDocument($exception->getMessage());
        }

        $map = $this->validationMapper->map($expansionResult);
        $this->validateTypesTree($map->getTree());
        $this->validationMapper->mapErrorsRanges($this->validationErrors, $parsedJsonLd, $this->hasAGraph);

        return $this->validationMapper->getMap();
    }

    private function reset(): void
    {
        $this->hasAGraph = false;
        $this->graphKey = 0;
        $this->typesStack = [];
        $this->validationErrors = [];
        $this->validationMapper->reset();
    }

    private function createMapWithInvalidDocument(string $message): ValidationMap
    {
        $error = new MappedError(
            $message,
            null,
            new Range(
                new Position(0, 0),
                new Position(0, 0)
            ),
            ValidationError::SEVERITY_ERROR
        );

        return new ValidationMap([$error], []);
    }

    /**
     * @param MappedType[] $types
     */
    private function validateTypesTree(array $types): void
    {
        if (\count($types) > 1) {
            $this->hasAGraph = true;
        }

        /**
         * @var MappedType $type
         */
        foreach ($types as $type) {
            $this->validateType($type);
        }
    }

    /**
     * This method will iterate over each of a type properties and validate them.
     * A type may contain other types as property values, so it will recursively call itself if some are found.
     */
    private function validateType(MappedType $type): void
    {
        if (null === $type->type) {
            $message = 'The @type entry of this type is missing.';
            $property = $type->properties[0];

            $this->addTypePropertyError(
                ValidationError::SEVERITY_ERROR,
                $message,
                $property->key
            );

            $property->errors[] = [ValidationError::SEVERITY_ERROR => $message];
        }

        /**
         * @var MappedProperty $property
         */
        foreach ($type->properties as $property) {
            if ($property->value instanceof MappedType) {
                $this->typesStack[] = $this->validationMapper->removeSchemaOrgDomain($property->key);

                $this->validateTypeProperty($property, $property->value);
                $this->validateType($property->value);

                array_pop($this->typesStack);

                continue;
            }

            if (\is_array($property->value)) {
                foreach ($property->value as $index => $multipleTypesEntry) {
                    // We only do somehting if the value is a MappedType
                    // If it is not, it means it is a value we should not validate, like a string or a boolean.
                    if ($multipleTypesEntry instanceof MappedType) {
                        $propertyShortName = $this->validationMapper->removeSchemaOrgDomain($property->key);

                        $this->typesStack[$propertyShortName][] = $propertyShortName;

                        $this->validateTypeProperty($property, $multipleTypesEntry);
                        $this->validateType($multipleTypesEntry);

                        if ($index === array_key_last($property->value)) {
                            array_pop($this->typesStack);
                        }
                    }
                }

                continue;
            }

            $this->validateRegularProperty($property, $type);
        }

        if ($this->hasAGraph) {
            ++$this->graphKey;
        }
    }

    private function validateTypeProperty(MappedProperty $property, MappedType $type): void
    {
        if (null === $type->type) {
            // Maybe we don't want to guess the type sometimes. For now, we always use the SchemaOrg validator so this is fine.
            $type->type = SchemaOrgValidator::guessTypeFromProperties($type->properties);

            $message = 'The @type entry of this typed value was not set. We had to guess it from its properties.';

            $this->addTypePropertyError(
                ValidationError::SEVERITY_WARNING,
                $message,
                $property->key
            );

            $property->errors[] = [ValidationError::SEVERITY_WARNING => $message];
        }

        foreach ($this->container->getValidators() as $validator) {
            $validationResult = $validator::validateTypeProperty($property->key, $type->type);

            foreach ($validationResult->errors as $error) {
                [$severity, $message] = $error;

                $property->errors[] = [$severity => $message];
                $this->addTypePropertyError($severity, $message, $property->key);
            }
        }
    }

    private function validateRegularProperty(MappedProperty $property, MappedType $type): void
    {
        if (null === $type->type) {
            return;
        }

        if (\in_array($property->key, [Keyword::VALUE->value, Keyword::ID->value], true)) {
            return;
        }

        foreach ($this->container->getValidators() as $validator) {
            $validationResult = $validator::validateRegularProperty($property->key, $type->type);

            foreach ($validationResult->errors as $error) {
                [$severity, $message] = $error;

                $property->errors[] = [$severity => $message];
                $this->addRegularPropertyError($severity, $message, $property->key);
            }
        }
    }

    private function addTypePropertyError(string $severity, string $message, string $key): void
    {
        // When an error is found on a type property, the invalid type is the type holding the property, not the property value, so we have to pop the stack.
        $typesStackClone = [...$this->typesStack];
        array_pop($typesStackClone);

        $this->validationErrors[] = new TypePropertyValidationError(
            $message,
            $key,
            $typesStackClone,
            $this->hasAGraph,
            $this->graphKey,
            $severity
        );
    }

    private function addRegularPropertyError(string $severity, string $message, string $key): void
    {
        $this->validationErrors[] = new RegularPropertyValidationError(
            $message,
            $key,
            $this->typesStack,
            $this->hasAGraph,
            $this->graphKey,
            $severity,
        );
    }
}
