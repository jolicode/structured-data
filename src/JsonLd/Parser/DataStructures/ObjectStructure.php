<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\DataStructures;

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\Properties\Key;
use Jolicode\JsonLd\Parser\Properties\Property;
use Jolicode\JsonLd\Parser\Properties\Value;
use Jolicode\JsonLd\Parser\Range;

class ObjectStructure extends AbstractStructure
{
    public function __construct(
        public ?AbstractStructure $belongsTo = null,
        public ?Range $range = null,
        /**
         * @var Property[]
         */
        private array $properties = [],
        /**
         * @var string[]
         */
        private array $duplicateKeys = [],
    ) {
    }

    public function hasProperty(string $name): bool
    {
        if (\array_key_exists($name, $this->properties)) {
            return true;
        }

        $name = str_replace('@', '', $name);

        return \array_key_exists($name, $this->properties);
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getProperty(string $name): Property
    {
        if (!\array_key_exists($name, $this->properties)) {
            $name = str_replace('@', '', $name);

            if (!\array_key_exists($name, $this->properties)) {
                throw new \InvalidArgumentException(\sprintf('Property "%s" does not exist on this type.', $name));
            }
        }

        return $this->properties[$name];
    }

    public function hasAGraph(): bool
    {
        return \array_key_exists(Keyword::GRAPH->value, $this->properties);
    }

    public function getGraph(): ArrayStructure
    {
        if (!$this->hasAGraph()) {
            throw new \InvalidArgumentException('This type does not have a graph.');
        }

        /* @phpstan-ignore-next-line */
        return $this->properties[Keyword::GRAPH->value]->value->content;
    }

    public function getGraphType(int $graphKey): mixed
    {
        if (!\array_key_exists(Keyword::GRAPH->value, $this->properties)) {
            throw new \InvalidArgumentException('This type does not have a graph.');
        }

        return $this->getGraph()->getValue($graphKey)->content;
    }

    public function getGraphProperty(string $name, int $graphKey): Property
    {
        return $this
            ->getGraphType($graphKey)
            ->getProperty($name);
    }

    // Graphs are ArrayStructures, so they don't have a property key, they only have numeric keys.
    // We cannot retrieve a Property, so we instead return a Value, which also holds a Range.
    public function getGraphValue(string $reference): Value
    {
        $foundValue = array_filter(
            $this->getGraph()->getValues(),
            static function (Value $value) use ($reference): bool {
                return $value->content instanceof ObjectStructure
                    && $value->content->hasProperty(Keyword::ID->value)
                    && $value->content->getProperty(Keyword::ID->value)->value?->content === $reference
                ;
            },
        );

        $firstFoundValueKey = array_key_first($foundValue);

        if (null === $firstFoundValueKey) {
            throw new \InvalidArgumentException(\sprintf('Graph value not found for reference "%s".', $reference));
        }

        return $foundValue[$firstFoundValueKey];
    }

    /**
     * @return string[]
     */
    public function getDuplicateKeys(): array
    {
        return $this->duplicateKeys;
    }

    public function addKey(string $name, Range $range): void
    {
        if (\array_key_exists($name, $this->properties) && !\in_array($name, $this->duplicateKeys, true)) {
            $this->duplicateKeys[] = $name;
        }

        $this->properties[$name] = new Property(new Key($name, $range));
    }

    public function addValue(AbstractStructure|string|bool|null $value, Range $range): void
    {
        $lastProperty = $this->getLastProperty();

        if (null !== $lastProperty) {
            $lastProperty->value = new Value($range, $value);
        }
    }

    public function getLastProperty(): ?Property
    {
        return end($this->properties) ?: null;
    }

    public function getLastValue(): ?Value
    {
        return $this->getLastProperty()?->value ?: null;
    }
}
