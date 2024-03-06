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

        /**
         * @var array<string,ValidationError>
         */
        private array $validationErrors = [],

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
            array_keys($this->container->getValidators())
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

        $map = $this->validationMapper->map($expandedJsonLd);

        foreach ($map->getTypes() as $type) {
            $this->validateType($type);
        }

        $this->validationMapper->mapErrorsRanges($this->validationErrors, $parsedJsonLd);

        return $this->validationMapper->getMap();
    }

    private function reset(): void
    {
        $this->typesStack = [];
        $this->validationErrors = [];
        $this->validationMapper->reset();
    }

    private function createMapWithInvalidDocument(string $message): ValidationMap
    {
        $error = new MappedError(
            $message,
            null,
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
    }

    private function callValidatorsForType(MappedType $type, ?MappedProperty $property): void
    {
        $graphKey = 0;
        $hasAGraph = false;

        if (\count($this->validationMapper->flattenedTypeReferences)) {
            $this->getGraphKey($type, $graphKey, $hasAGraph);
        }

        $validators = $this->specificValidator
            ? [$this->container->getValidator($this->specificValidator)]
            : $this->container->getValidators();

        foreach ($validators as $validator) {
            $errors = $validator::validateType($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $typeLabel = \is_string($type->type) ? Keyword::TYPE->value : null;

                $this->addTypeError($severity, $message, $typeLabel, $hasAGraph, $graphKey, $validator::VALIDATOR_NAME);
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

        $graphKey = 0;
        $hasAGraph = false;

        if (\count($this->validationMapper->flattenedTypeReferences)) {
            $this->getGraphKey($type, $graphKey, $hasAGraph);
        }

        $validators = $this->specificValidator
            ? [$this->container->getValidator($this->specificValidator)]
            : $this->container->getValidators();

        foreach ($validators as $validator) {
            $errors = $validator::validateProperty($type, $property, $this->typesStack);

            foreach ($errors as $error) {
                [$severity, $message] = $error;

                $property->errors[] = [$severity => $message];
                $this->addPropertyError($severity, $message, $property->key, $hasAGraph, $graphKey, $validator::VALIDATOR_NAME);
            }
        }
    }

    private function getGraphKey(MappedType $type, int &$graphKey, bool &$hasAGraph): void
    {
        $hasAGraph = true;

        $graphKey = array_search(
            $type,
            $this->validationMapper->flattenedTypeReferences,
            true
        );

        $graphKey = array_search(
            $graphKey,
            array_keys($this->validationMapper->flattenedTypeReferences), true
        );
    }

    private function addTypeError(
        string $severity,
        string $message,
        ?string $typeLabel,
        bool $hasAGraph,
        int $graphKey,
        string $validatorName,
    ): void {
        $this->validationErrors[] = new TypeValidationError(
            $message,
            $typeLabel,
            $this->typesStack,
            $hasAGraph,
            $graphKey,
            $severity,
            $validatorName
        );
    }

    private function addPropertyError(
        string $severity,
        string $message,
        string $key,
        bool $hasAGraph,
        int $graphKey,
        string $validatorName,
    ): void {
        $this->validationErrors[] = new PropertyValidationError(
            $message,
            $key,
            $this->typesStack,
            $hasAGraph,
            $graphKey,
            $severity,
            $validatorName
        );
    }
}
