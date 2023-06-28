<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg\Types;

use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;

class ElementsContainer
{
    public function __construct(
        /**
         * @var array<string, Type>
         */
        private array $types = [],

        /**
         * @var array<string, Type>
         */
        private array $typesAliases = [],

        /**
         * @var array<string, Property>
         */
        private array $properties = [],

        /**
         * @var array<string, EnumerationMember>
         */
        private array $enumerationMembers = [],
    ) {
    }

    public function addType(Type $type): void
    {
        if (!\array_key_exists($type->name, $this->types)) {
            $this->types[$type->name] = $type;
        }

        foreach ($type->equivalentClass as $equivalentClass) {
            if (\is_array($equivalentClass)) {
                $this->typesAliases[$equivalentClass[Extractor::KEY_ID]] = $type;
            } else {
                $this->typesAliases[$equivalentClass] = $type;
            }
        }
    }

    public function addProperty(Property $property): void
    {
        if (!\array_key_exists($property->name, $this->properties)) {
            $this->properties[$property->name] = $property;
        }
    }

    public function addEnumerationMember(EnumerationMember $enumerationMember): void
    {
        if (!\array_key_exists($enumerationMember->name, $this->properties)) {
            $this->enumerationMembers[$enumerationMember->name] = $enumerationMember;
        }
    }

    /**
     * @return array<string, Type>
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    public function getType(string $name): Type
    {
        if (!\array_key_exists($name, $this->types)) {
            return $this->typesAliases[$name];
        }

        return $this->types[$name];
    }

    /**
     * @return array<string, Property>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getProperty(string $name): Property
    {
        return $this->properties[$name];
    }

    /**
     * @return array<string, EnumerationMember>
     */
    public function getEnumerationMembers(): array
    {
        return $this->enumerationMembers;
    }

    public function getEnumerationMember(string $name): EnumerationMember
    {
        return $this->enumerationMembers[$name];
    }

    /**
     * @return array<string, Type|Property|EnumerationMember>
     */
    public function getAllElements(): array
    {
        return [...$this->types, ...$this->properties, ...$this->enumerationMembers];
    }

    public function finish(): void
    {
        $this->mapPropertiesToTypes();
        $this->mapEnumerationMembersToTypes();
    }

    public function mapPropertiesToTypes(): void
    {
        foreach ($this->getProperties() as $property) {
            foreach ($property->possibleTypes as $typeName) {
                $this->getType($typeName)->addProperty($property);
            }
        }

        foreach ($this->getTypes() as $type) {
            foreach ($type->parents as $parent) {
                $this->addParentsProperties($type, $parent);
            }
        }
    }

    public function mapEnumerationMembersToTypes(): void
    {
        foreach ($this->getEnumerationMembers() as $enumerationMember) {
            foreach ($enumerationMember->inTypes as $typeName) {
                $this->getType($typeName)->addEnumerationMember($enumerationMember);
            }
        }
    }

    private function addParentsProperties(Type $type, string $parentName): void
    {
        $parent = $this->getType($parentName);

        foreach ($parent->properties as $property) {
            $type->addProperty($property);
        }

        foreach ($parent->parents as $grandParent) {
            $this->addParentsProperties($type, $grandParent);
        }
    }
}
