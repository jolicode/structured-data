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

/**
 * @class MainType MainTypes are the first types of the pages.
 */
class MainType extends AbstractType
{
    public function __construct(
        /**
         * The name(s) used to identify the type.
         */
        public ?string $name = null,

        /**
         * Only used for the Learning Video page.
         * Types on this page are actually a combination of 2 types.
         *
         * @var array<string> $multipleTypes
         */
        public array $multipleTypes = [],

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
         * @var array<string, MainType>
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
        parent::__construct($name);
    }

    /**
     * A method used to set the right name to identify subtypes (it basically adds the subtype name to the main type name).
     */
    public function setCurrentTypeSubtype(string $newName): void
    {
        foreach ($this->currentProperties as $currentProperty) {
            $originalType = $currentProperty->types[array_key_last($currentProperty->types)];
            $originalName = $originalType->name;

            unset($currentProperty->types[$originalName]);

            $newName = sprintf('%s %s', $originalName, $newName);
            $originalType->name = $newName;

            $currentProperty->types[$newName] = $originalType;
        }
    }

    /**
     * Sometimes (for now, only the book page) a title and its table are meant to update a previous type.
     * When this is the case, we need to find which value to update, and initalize new properties for it.
     * And these properties may even be nested properties, which complicates things.
     * This method is here to handle these (rare) cases.
     *
     * @param string                      $fullPropertyName the full property name, which may be a nested property, indicated by dots
     * @param array<string|array<string>> $propertyToUpdate an array representing the property to update, and the types associated
     */
    public function updateTypeWithProperty(string $fullPropertyName, array $propertyToUpdate, string $severity, bool $isBeta = false): void
    {
        $this->currentProperties = [];

        /**
         * @var string        $property
         * @var array<string> $types
         */
        [$property, $types] = $propertyToUpdate;

        if ($this->hasProperty($property)) {
            $propertiesChain = explode('.', $fullPropertyName);
            $targetProperties = "{$severity}Properties";

            $this->addPropertiesToTypes(
                $this->getProperty($property),
                $propertiesChain,
                $types,
                $targetProperties,
                $isBeta,
            );
        }
    }

    /**
     * @param Property      $propertyToUpdate      The initial property to add the new property to
     * @param array<string> $propertyTypesToUpdate The initial property values we want to update
     */
    private function addPropertiesToTypes(
        Property $propertyToUpdate,
        array $propertiesChain,
        array $propertyTypesToUpdate,
        string $targetProperties,
        bool $isBeta,
    ): void {
        $actualPropertyName = array_shift($propertiesChain);

        if (null === $actualPropertyName) {
            throw new \RuntimeException('Error while attempting to update a nested property : Reached end of properties chain without finding a property name.');
        }

        // If the property is not found, it means we reached the property we want to add the value to.
        if (!$foundProperty = $propertyToUpdate->getProperty($actualPropertyName, $propertyTypesToUpdate[array_key_first($propertyTypesToUpdate)])) {
            if (\count($propertiesChain)) {
                throw new \RuntimeException('Error while attempting to update a nested property : Found a property name but the properties chain is not empty.');
            }

            foreach ($propertyTypesToUpdate as $type) {
                $type = $propertyToUpdate->getType($type);

                $type->addProperty($actualPropertyName, $targetProperties, isBeta: $isBeta);

                $this->currentProperties[] = $type->getProperty($actualPropertyName);
            }

            return;
        }

        $propertyTypesToUpdate = array_map(
            fn (PropertyType $type): string => $type->name,
            $foundProperty->types
        );

        // Else, recursively call this method to find the property.
        $this->addPropertiesToTypes($foundProperty, $propertiesChain, $propertyTypesToUpdate, $targetProperties, $isBeta);
    }
}
