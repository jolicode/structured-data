<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Mapper;

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\DataStructures\StructureInterface;
use Jolicode\JsonLd\Validation\Error\AbstractValidationError;
use Jolicode\JsonLd\Validation\Error\DocumentValidationError;
use Jolicode\JsonLd\Validation\Error\TypeValidationError;

class ValidationMapper
{
    public function __construct(
        /**
         * @var array<AbstractValidationError>
         */
        private array $errors = [],

        private ValidationMap $map = new ValidationMap(),
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    public function addErrors(AbstractValidationError ...$errors): void
    {
        foreach ($errors as $error) {
            $this->errors[] = $error;
        }
    }

    /**
     * @return array<AbstractValidationError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function mapErrorsOnTypes(StructureInterface $parsedJsonLd): void
    {
        if ($parsedJsonLd instanceof ArrayStructure) {
            return;
        }

        foreach ($this->getErrors() as $error) {
            if ($error instanceof DocumentValidationError) {
                $parsedJsonLd->error = $error;
            }

            if ($error instanceof TypeValidationError) {
                $typeWithViolation = $this->getTypeWithViolation($error, $parsedJsonLd);

                if (null === $error->key) {
                    $typeWithViolation->addError($error);
                } else {
                    $propertyWithViolation = $error->onGraph ?
                        $typeWithViolation->getGraphProperty($error->key, $error->graphKey) :
                        $typeWithViolation->getProperty($error->key);

                    $propertyWithViolation->addError($error);
                }
            }
        }
    }

    public function getMap(StructureInterface $parsedJson): ValidationMap
    {
        if (!$this->isValid()) {
            dd($parsedJson);
        }

        return $this->map;
    }

    private function getTypeWithViolation(TypeValidationError $error, ObjectStructure $parsedJsonLd): ObjectStructure
    {
        if (0 === \count($error->parents)) {
            return $parsedJsonLd;
        }

        $rootType = $parsedJsonLd;
        $currentType = $rootType;

        if ($error->onGraph) {
            /**
             * @var ArrayStructure $graph
             */
            $graph = $currentType->getProperty(Keyword::GRAPH->value)->value->content;
            $graphEntries = $graph->getValues();
            $currentType = $graphEntries[$error->graphKey]->content;
        }

        foreach ($error->parents as $parent) {
            $currentType = $this->retrieveTypeFromProperty($parent, $currentType);
        }

        return $currentType;
    }

    private function retrieveTypeFromProperty(string|array $property, ObjectStructure $currentType): ObjectStructure
    {
        $properties = $currentType->getProperties();

        if (\is_array($property)) {
            $propertyWithError = $properties[$property[0]];
        } else {
            $propertyWithError = $properties[$property];
        }

        $typeWithError = $propertyWithError->value->content;

        if ($typeWithError instanceof ArrayStructure) {
            if (\is_array($property)) {
                $typeWithError = $typeWithError->getValues()[\count($property) - 1]->content;
            } else {
                $typeWithError = $typeWithError->getValues()[0]->content;
            }
        }

        return $typeWithError;
    }
}
