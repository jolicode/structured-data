<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google\Objects;

class RootType extends AbstractType
{
    public function __construct(
        /**
         * The name(s) used to identify the type.
         */
        public string|array $names = [],

        /**
         * Used to retrieve properties from another type. Only used for LearningVideos and LearningClips for now.
         *
         * @var string|array<string>|null $types
         */
        public string|array|null $dependsOn = null,

        /**
         * The link to the type documentation.
         */
        public ?string $documentationUrl = null,

        /**
         * Used on the book page, which has 2 different types of books, and for carousels as well.
         */
        public bool $isASubtype = false,
        public ?self $parentType = null,

        /**
         * @var array<string, RootType>
         */
        public array $subTypes = [],

        /**
         * Some types are eligible for a carousel display.
         */
        public bool $isCarouselEligible = false,

        /**
         * Carousels have base required/recommended properties but they may use some others as well.
         */
        public ?PropertyType $carousel = null,
    ) {
        parent::__construct($names);
    }

    /**
     * A method used to set the right name to identify subtypes (it basically adds the subtype name to the main type name).
     */
    public function setCurrentTypeSubtype(string $newName): void
    {
        foreach ($this->currentProperties as $currentProperty) {
            $originalType = $currentProperty->values[array_key_last($currentProperty->values)];
            $originalName = $originalType->name;

            unset($currentProperty->values[$originalName]);

            $newName = sprintf('%s %s', $originalName, $newName);
            $originalType->name = $newName;

            $currentProperty->values[$newName] = $originalType;
        }
    }

    /**
     * Sometimes (for now, only the book page however) a title and its table are meant to update a previous type.
     * When this is the case, we need to find which value to update, and initalize new properties for it.
     * And these properties may even be nested properties, which complicates things.
     * This method is here to handle these (rare) cases.
     */
    public function updateTypeWithProperty(string $name, array $propertyToUpdate, string $severity, bool $isBeta = false): void
    {
        /**
         * @var string        $property
         * @var array<string> $types
         */
        [$property, $types] = $propertyToUpdate;

        if ($this->hasProperty($property)) {
            $this->addNestedPropertyToType(
                $this->getProperty($property),
                $types,
                $severity,
                $name,
                $isBeta
            );
        }
    }

    /**
     * @param Property      $property      The initial property to add the new property to
     * @param array<string> $typesToUpdate The initial property values we want to update
     * @param string        $propertyName  The full name of the new property (which may contain dots, indicating a nested property)
     * @param string        $severity      The severity of the property (recommended/required)
     */
    private function addNestedPropertyToType(
        Property $property,
        array $typesToUpdate,
        string $severity,
        string $propertyName,
        bool $isBeta,
    ): void {
        $propertiesChain = explode('.', $property->name);
        $targetProperties = "{$severity}Properties";

        $this->addPropertiesToTypes(
            $property,
            $propertyName,
            $propertiesChain,
            $typesToUpdate,
            $targetProperties,
            $isBeta,
        );

        $this->currentProperties = [$property];
    }

    private function addPropertiesToTypes(
        Property $propertyToUpdate,
        string $propertyToCreate,
        array $propertiesChain,
        array $propertyTypesToUpdate,
        string $targetProperties,
        bool $isBeta,
    ): void {
        $propertyName = array_shift($propertiesChain);

        if (null === $propertyName) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : Reached end of properties chain without finding a property name.');
        }

        // If the property is not found, it means we reached the property we want to add the value to.
        if (!$foundProperty = $propertyToUpdate->getProperty($propertyName)) {
            foreach ($propertyTypesToUpdate as $type) {
                $type = $propertyToUpdate->getType($type);
                $type->addProperty($propertyToCreate, $targetProperties, isBeta: $isBeta);

                $this->currentProperties[] = $type->getProperty($propertyToCreate);
            }

            return;
        }

        // Else, recursively call this method to find the property.
        $this->addPropertiesToTypes($foundProperty, $propertyToCreate, $propertiesChain, $propertyTypesToUpdate, $targetProperties, $isBeta);
    }
}
