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
    ) {
    }

    public function hasProperty(string $name): bool
    {
        return \array_key_exists($name, $this->properties);
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getProperty(?string $name): Property
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

    public function getGraphProperty(?string $name, int $graphKey): Property
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
            /* @phpstan-ignore-next-line */
            fn (Value $value) => $value->content->getProperty(Keyword::ID->value)->value->content === $reference,
        );

        return $foundValue[array_key_first($foundValue)];
    }

    public function addKey(string $name, Range $range): void
    {
        $this->properties[$name] = new Property(new Key($name, $range));
    }

    public function addValue(AbstractStructure|string|bool|null $value, Range $range): void
    {
        end($this->properties)->value = new Value($range, $value);
    }

    public function getLastValue(): Value
    {
        return end($this->properties)->value;
    }
}
