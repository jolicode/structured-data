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
use Jolicode\JsonLd\Validation\Error\AbstractValidationError;

class ObjectStructure implements StructureInterface
{
    public function __construct(
        public ?StructureInterface $belongsTo = null,

        /**
         * @var Property[]
         */
        private array $properties = [],

        /**
         * @var AbstractValidationError[]
         */
        private array $errors = [],
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
        return $this->properties[$name];
    }

    public function getGraphType(int $graphKey): self
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

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    public function addError(AbstractValidationError $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return AbstractValidationError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
