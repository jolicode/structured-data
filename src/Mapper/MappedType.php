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

class MappedType
{
    public function __construct(
        private string $sourceFormat,
        private string|array|null $type = null,
        private string|array|null $originalType = null,
        private ?string $name = null,
        private ?string $description = null,
        private bool $isValid = true,
        private ?string $errorSeverity = null,
        /**
         * @var array<MappedProperty>
         */
        private array $properties = [],
        /**
         * @var array<MappedError>
         */
        private array $errors = [],
        /**
         * @var array<MappedError>
         */
        private array $childrenErrors = [],
        /**
         * @var array<MappedError>|null
         */
        private ?array $mergedErrors = null,
        private ?self $parent = null,
        private ?MappedProperty $parentProperty = null,
        /**
         * @var array<self>
         */
        private array $children = [],
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
        /**
         * @var array<string>
         */
        private array $duplicateKeys = [],
        private ?string $documentationLink = null,
    ) {
    }

    public function getType(): string|array|null
    {
        return $this->type;
    }

    /**
     * @return array<string>
     */
    public function getDuplicateKeys(): array
    {
        return $this->duplicateKeys;
    }

    /**
     * @param array<string> $duplicateKeys
     */
    public function setDuplicateKeys(array $duplicateKeys): void
    {
        $this->duplicateKeys = $duplicateKeys;
    }

    public function getOriginalType(): string|array|null
    {
        return $this->originalType;
    }

    public function setOriginalType(string|array|null $originalType): void
    {
        $this->originalType = $originalType;
    }

    public function setType(string|array|null $type): void
    {
        $this->type = $type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns true if the type itself is valid, even if is children have errors.
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Returns true if both the type and all its children are valid.
     */
    public function isFullyValid(): bool
    {
        return $this->isValid && 0 === \count($this->getChildrenErrors());
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    /**
     * Returns the highest error severity found on the type or any of its children
     * (so if the type in itself only has a warning, but a children has an error, this method will return `error`).
     */
    public function getErrorSeverity(): ?string
    {
        return $this->errorSeverity;
    }

    public function setErrorSeverity(?string $errorSeverity): void
    {
        $this->errorSeverity = $errorSeverity;
    }

    /**
     * @return array<MappedProperty>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setProperty(string $name, MappedProperty $property): void
    {
        $this->properties[$name] = $property;
    }

    public function hasProperty(string $name): bool
    {
        return isset($this->properties[$name]);
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

        if (null !== $this->mergedErrors) {
            $this->mergedErrors = null;
        }
    }

    public function addChildrenError(MappedError $error): void
    {
        $this->childrenErrors[] = $error;

        if (null !== $this->mergedErrors) {
            $this->mergedErrors = null;
        }
    }

    /**
     * @return array<MappedError>
     */
    public function getChildrenErrors(): array
    {
        return $this->childrenErrors;
    }

    /**
     * Returns both the type errors and the children errors.
     *
     * @return array<MappedError>
     */
    public function getMergedErrors(): array
    {
        if (null !== $this->mergedErrors) {
            return $this->mergedErrors;
        }

        if (!$this->errors) {
            return $this->mergedErrors = $this->childrenErrors;
        }

        if (!$this->childrenErrors) {
            return $this->mergedErrors = $this->errors;
        }

        $mergedById = [];

        foreach ($this->errors as $error) {
            $mergedById[spl_object_id($error)] = $error;
        }

        foreach ($this->childrenErrors as $error) {
            $mergedById[spl_object_id($error)] = $error;
        }

        return $this->mergedErrors = array_values($mergedById);
    }

    public function hasError(MappedError $error): bool
    {
        if (!$this->errors) {
            return false;
        }

        return \in_array($error, $this->errors, true);
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): void
    {
        $this->parent = $parent;
    }

    public function getParentProperty(): ?MappedProperty
    {
        return $this->parentProperty;
    }

    public function setParentProperty(?MappedProperty $parentProperty): void
    {
        $this->parentProperty = $parentProperty;
    }

    /**
     * @return array<self>
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(self $child): void
    {
        $this->children[] = $child;
    }

    /**
     * @return array<Range>
     */
    public function getKeyRanges(): array
    {
        return $this->keyRanges;
    }

    /**
     * @return array<Range>
     */
    public function getValueRanges(): array
    {
        return $this->valueRanges;
    }

    /**
     * @return array<string>
     */
    public function getIsPartOf(): array
    {
        return $this->isPartOf;
    }

    /**
     * @param array<string> $isPartOf
     */
    public function setIsPartOf(array $isPartOf): void
    {
        $this->isPartOf = $isPartOf;
    }

    /**
     * @return array<string>
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @param array<string> $source
     */
    public function setSource(array $source): void
    {
        $this->source = $source;
    }

    public function addKeyRange(Range $range): void
    {
        if (!$this->keyRanges) {
            $this->keyRanges[] = $range;

            return;
        }

        if (!\in_array($range, $this->keyRanges, true)) {
            $this->keyRanges[] = $range;
        }
    }

    public function getSourceFormat(): string
    {
        return $this->sourceFormat;
    }

    public function setSourceFormat(string $sourceFormat): void
    {
        $this->sourceFormat = $sourceFormat;
    }

    public function addValueRange(Range $range): void
    {
        if (!$this->valueRanges) {
            $this->valueRanges[] = $range;

            return;
        }

        if (!\in_array($range, $this->valueRanges, true)) {
            $this->valueRanges[] = $range;
        }
    }

    public function getDocumentationLink(): ?string
    {
        return $this->documentationLink;
    }

    public function setDocumentationLink(?string $link): void
    {
        $this->documentationLink = $link;
    }

    public function getProperty(string $name): ?MappedProperty
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }

    public function getPath(): ?string
    {
        if ($path = $this->getParentProperty()?->getPath()) {
            return $path;
        }

        $type = $this->type;

        if (\is_string($type)) {
            return $type;
        }

        if (!\is_array($type)) {
            return null;
        }

        if (!isset($type[1])) {
            return $type[0] ?? '';
        }

        return '(' . implode('|', $type) . ')';
    }
}
