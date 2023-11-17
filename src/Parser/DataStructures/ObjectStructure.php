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

class ObjectStructure implements StructureInterface
{
    public function __construct(
        public ?StructureInterface $belongsTo = null,

        /**
         * @var Property[]
         */
        private array $properties = [],
    ) {
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
            if (Keyword::tryFrom($name)) {
                return $this->properties[str_replace('@', '', $name)];
            }

            throw new \InvalidArgumentException(sprintf('Property "%s" does not exist on this type.', $name));
        }

        return $this->properties[$name];
    }

    public function getGraphType(int $graphKey): mixed
    {
        /**
         * @var ArrayStructure $graph
         */
        $graph = $this->properties[Keyword::GRAPH->value]->value->content;

        return $graph->getValue($graphKey)->content;
    }

    public function getGraphProperty(?string $name, int $graphKey): Property
    {
        return $this
            ->getGraphType($graphKey)
            ->getProperty($name);
    }

    public function addKey(string $name, Range $range): void
    {
        $this->properties[$name] = new Property(new Key($name, $range));
    }

    public function addValue(StructureInterface|string|bool|null $value, Range $range): void
    {
        end($this->properties)->value = new Value($value, $range);
    }

    public function getLastValue(): Value
    {
        return end($this->properties)->value;
    }
}
