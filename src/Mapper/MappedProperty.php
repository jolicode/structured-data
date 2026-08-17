<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\JsonLd\Parser\Range;

class MappedProperty
{
    public function __construct(
        private readonly string $key,
        private ?MappedType $type = null,
        private ?string $originalKey = null,
        private ?string $description = null,
        /**
         * Normalized property value extracted from JSON-LD.
         *
         * - Scalar values are stored directly (`string|int|bool`).
         * - Embedded object values are mapped as `MappedType`.
         * - Multi-valued entries are stored as arrays containing scalars and/or `MappedType`.
         *
         * @var mixed
         */
        private mixed $value = [],
        private bool $isValid = true,
        private ?string $errorSeverity = null,
        /**
         * @var array<MappedError>
         */
        private array $errors = [],
        /**
         * @var array<Range>
         */
        private array $keyRanges = [],
        /**
         * @var array<Range>
         */
        private array $valueRanges = [],
        /**
         * @var array<string>
         */
        private array $isPartOf = [],
        /**
         * @var array<string>
         */
        private array $source = [],
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOriginalKey(): ?string
    {
        return $this->originalKey;
    }

    public function setOriginalKey(?string $originalKey): void
    {
        $this->originalKey = $originalKey;
    }

    /**
     * Returns the MappedType that owns this property.
     */
    public function getOwnerType(): ?MappedType
    {
        return $this->type;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * Appends an item to the value array. When $key is provided the item is stored at that index.
     */
    public function appendValue(mixed $item, string|int|null $key = null): void
    {
        if (null === $key) {
            $this->value[] = $item;
        } else {
            $this->value[$key] = $item;
        }
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function getErrorSeverity(): ?string
    {
        return $this->errorSeverity;
    }

    public function setErrorSeverity(?string $errorSeverity): void
    {
        $this->errorSeverity = $errorSeverity;
    }

    /**
     * @return array<MappedError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(MappedError $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return array<Range>
     */
    public function getKeyRanges(): array
    {
        return $this->keyRanges;
    }

    public function addKeyRange(Range $range): void
    {
        if (!\in_array($range, $this->keyRanges, true)) {
            $this->keyRanges[] = $range;
        }
    }

    /**
     * @return array<Range>
     */
    public function getValueRanges(): array
    {
        return $this->valueRanges;
    }

    public function addValueRange(Range $range): void
    {
        if (!\in_array($range, $this->valueRanges, true)) {
            $this->valueRanges[] = $range;
        }
    }

    /**
     * @return array<string>
     */
    public function getIsPartOf(): array
    {
        return $this->isPartOf;
    }

    public function addIsPartOf(array $items): void
    {
        $this->isPartOf = array_merge($this->isPartOf, $items);
    }

    /**
     * @return array<string>
     */
    public function getSource(): array
    {
        return $this->source;
    }

    public function addSource(array $items): void
    {
        $this->source = array_merge($this->source, $items);
    }

    public function getPath(): string
    {
        $path = $this->key;

        if ($this->type?->getParentProperty()) {
            $path = $this->type->getParentProperty()->getPath();
            $path = $path . '.' . $this->key;
        }

        return $path;
    }
}
