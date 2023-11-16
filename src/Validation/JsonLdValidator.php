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
use Jolicode\JsonLd\Validation\Error\PropertyValidationError;
use Jolicode\JsonLd\Validation\Error\TypeValidationError;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\MappedProperty;
use Jolicode\JsonLd\Validation\Mapper\MappedType;
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
use Jolicode\JsonLd\Validation\Mapper\ValidationMapper;
use Jolicode\JsonLd\Validation\Validators\RegisteredValidatorsContainer;
use JsonStreamingParser\Exception\ParsingException;

class JsonLdValidator
{
    public function __construct(
        private bool $hasAGraph = false,

        private int $graphKey = 0,

        /**
         * @var array<string, string|array<string>>
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
     * This method will iterate over each type of a property and validate them.
     * A type may contain other types as property values, so it will recursively call itself if some are found.
     */
    private function validateType(MappedType $type, MappedProperty $originalProperty = null): void
    {
        $this->callValidatorsForType($type, $originalProperty);

        /**
         * @var MappedProperty $property
         */
        foreach ($type->properties as $property) {
            if ($property->value instanceof MappedType) {
                $this->typesStack[] = $this->validationMapper->removeSchemaOrgDomain($property->key);

                $this->validateType($property->value, $property);

                array_pop($this->typesStack);

                continue;
            }

            if (\is_array($property->value)) {
                foreach ($property->value as $index => $multipleTypesEntry) {
                    if ($multipleTypesEntry instanceof MappedType) {
                        /**
                         * @var string $propertyShortName
                         */
                        $propertyShortName = $this->validationMapper->removeSchemaOrgDomain($property->key);

                        $this->typesStack[$propertyShortName][] = $propertyShortName;

                        $this->validateType($multipleTypesEntry, $property);

                        if ($index === array_key_last($property->value)) {
                            array_pop($this->typesStack);
                        }

                        continue;
                    }
                }

                continue;
            }

            $this->callValidatorsForProperty($property, $type);
        }

        if ($this->hasAGraph) {
            ++$this->graphKey;
        }
    }

    private function callValidatorsForType(MappedType $type, ?MappedProperty $property): void
    {
        foreach ($this->container->getValidators() as $validator) {
            $errors = $validator::validateType($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $typeLabel = \is_string($type->type) ? Keyword::TYPE->value : null;

                $this->addTypeError($severity, $message, $typeLabel);
            }
        }
    }

    private function callValidatorsForProperty(MappedProperty $property, MappedType $type): void
    {
        if (null === $type->type) {
            return;
        }

        if (\in_array($property->key, [Keyword::VALUE->value, Keyword::ID->value], true)) {
            return;
        }

        foreach ($this->container->getValidators() as $validator) {
            $errors = $validator::validateProperty($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $property->errors[] = [$severity => $message];
                $this->addPropertyError($severity, $message, $property->key);
            }
        }
    }

    private function addTypeError(string $severity, string $message, ?string $typeLabel): void
    {
        $this->validationErrors[] = new TypeValidationError(
            $message,
            $typeLabel,
            $this->typesStack,
            $this->hasAGraph,
            $this->graphKey,
            $severity
        );
    }

    private function addPropertyError(string $severity, string $message, string $key): void
    {
        $this->validationErrors[] = new PropertyValidationError(
            $message,
            $key,
            $this->typesStack,
            $this->hasAGraph,
            $this->graphKey,
            $severity,
        );
    }
}
