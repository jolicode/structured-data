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

readonly class MappedError implements \JsonSerializable
{
    public const SEVERITY_ERROR = 'error';
    public const SEVERITY_WARNING = 'warning';

    public function __construct(
        private string $message,
        private ?string $property,
        private ?string $type,
        private string $severity,
        private ?string $validatorName,
        private string $ranges,
        private MappedType|MappedProperty|null $parent = null,
    ) {
    }

    #[\Override]
    public function jsonSerialize(): mixed
    {
        return [
            'message' => $this->getMessage(),
            'property' => $this->getProperty(),
            'type' => $this->getType(),
            'severity' => $this->getSeverity(),
            'validatorName' => $this->getValidatorName(),
            'ranges' => $this->getRanges(),
            'path' => $this->getPath(),
        ];
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getFormattedMessage(): string
    {
        return \sprintf(
            '[%s %s] %s%s',
            $this->getValidatorName(),
            $this->getSeverity(),
            $this->parent && $this->parent->getPath()
                ? ($this->parent->getPath() . ': ')
                : '',
            $this->getMessage(),
        );
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSeverity(): string
    {
        return $this->severity;
    }

    public function getValidatorName(): ?string
    {
        return $this->validatorName;
    }

    public function getRanges(): string
    {
        return $this->ranges;
    }

    public function getParent(): MappedType|MappedProperty|null
    {
        return $this->parent;
    }

    public function getPath(): string
    {
        $parentPath = $this->parent?->getPath();

        if ($parentPath) {
            return $parentPath;
        }

        if ($this->property) {
            return $this->property;
        }

        if ($this->type) {
            return $this->type;
        }

        return '';
    }
}
