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

use Jolicode\JsonLd\Generator\Google\Extractor;

abstract class AbstractType
{
    public function __construct(
        /**
         * The name(s) used to identify the type.
         */
        public string|array $names = [],

        /**
         * @var array<string, Property>
         */
        protected array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        protected array $recommendedProperties = [],

        /**
         * @var array<string, Property> $currentProperties
         */
        protected array $currentProperties = [],

        protected int $atLeastOneOfCounter = 0,
    ) {
    }

    public function hasProperty(string $property): bool
    {
        return \array_key_exists($property, $this->requiredProperties)
            || \array_key_exists($property, $this->recommendedProperties);
    }

    public function hasRequiredProperties(): bool
    {
        return \count($this->requiredProperties);
    }

    public function hasRecommendedProperties(): bool
    {
        return \count($this->recommendedProperties);
    }

    public function getProperty(string $name): ?Property
    {
        return $this->requiredProperties[$name]
        ?? $this->recommendedProperties[$name]
        ?? null;
    }

    public function initProperty(string $name, string $severity, bool $isBeta = false, array $atLeastOneOf = []): void
    {
        $targetProperties = "{$severity}Properties";

        if ($atLeastOneOf) {
            $name = 'atLeastOneOf_' . $this->atLeastOneOfCounter++;
        }

        if (Extractor::SEVERITY_RECOMMENDED === $severity && \array_key_exists($name, $this->requiredProperties)) {
            $this->recommendedProperties[$name] = $this->requiredProperties[$name];
            $this->currentProperties = [$this->recommendedProperties[$name]];

            unset($this->requiredProperties[$name]);

            return;
        }

        if (!\array_key_exists($name, $this->{$targetProperties})) {
            $this->{$targetProperties}[$name] = new Property($name, atLeastOneOf: $atLeastOneOf, isBeta: $isBeta);
        }

        $this->currentProperties = [$this->{$targetProperties}[$name]];
    }

    public function pushProperty(string $type, bool $isBeta = false): void
    {
        foreach ($this->currentProperties as $currentProperty) {
            $currentProperty->addType($type, $isBeta);
        }
    }

    /**
     * Removes empty properties and builds the nested properties.
     */
    public function cleanUpProperties(): void
    {
        $this->cleanUpTargetProperties(Extractor::SEVERITY_REQUIRED);
        $this->cleanUpTargetProperties(Extractor::SEVERITY_RECOMMENDED);

        if ($this instanceof RootType) {
            if (\count($this->subTypes)) {
                foreach ($this->subTypes as $subType) {
                    $subType->cleanUpProperties();
                }
            }
        }

        $this->currentProperties = [];
    }

    /**
     * Nested properties are (most of the time...) indicated thanks to a dot notation, like `firstProperty.secondProperty`.
     * This method will split the string to get the properties chain and initialize a property on the last element of the chain.
     */
    protected function handleNestedProperty(Property $property, string $severity): void
    {
        $propertiesChain = explode('.', $property->name);

        if (1 === \count($propertiesChain)) {
            $firstPropertyName = $property->name;
        } else {
            $firstPropertyName = array_shift($propertiesChain);
        }

        if (null === $firstPropertyName) {
            throw new \RuntimeException(sprintf('Trying to parse a nested property but the following provided string is invalid : "%s"', $property->name));
        }

        $actualFirstProperty = $this->getProperty($firstPropertyName);

        if (null === $actualFirstProperty) {
            $this->initProperty($firstPropertyName, $severity, isBeta: $property->isBeta);

            foreach ($property->types as $type) {
                $this->pushProperty($type->names, isBeta: $property->isBeta);
            }

            $actualFirstProperty = $this->getProperty($firstPropertyName);
        }

        if (null === $actualFirstProperty) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : The first property of the chain could not be found.');
        }

        $this->initializeNestedProperty($propertiesChain, $actualFirstProperty, $property->types, $severity);
    }

    /**
     * @param array<string> $propertiesChain
     * @param array<mixed>  $typesToAdd
     */
    private function initializeNestedProperty(
        array $propertiesChain, Property $property, array $typesToAdd, string $severity
    ): void {
        $propertyName = array_shift($propertiesChain);

        if (null === $propertyName) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : Reached end of properties chain without finding a property name.');
        }

        $targetProperties = "{$severity}Properties";

        if ($foundProperty = $property->getProperty($propertyName)) {
            $this->initializeNestedProperty($propertiesChain, $foundProperty, $typesToAdd, $severity);

            return;
        }

        $property->addProperties($propertyName, $targetProperties, isBeta: $property->isBeta);

        $this->currentProperties = [$property->getProperty($propertyName)];
    }

    private function cleanUpTargetProperties(string $severity): void
    {
        $targetProperties = "{$severity}Properties";

        foreach ($this->{$targetProperties} as $property) {
            if (!\count($property->types)) {
                unset($this->{$targetProperties}[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                $this->handleNestedProperty($property, $severity);

                unset($this->{$targetProperties}[$property->name]);
            }
        }

        ksort($this->{$targetProperties});
    }
}
