<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Mapper;

use Jolicode\JsonLd\Parser\Range;

class MappedType
{
    public function __construct(
        public string|array|null $type = null,
        public ?string $name = null,
        public ?string $description = null,
        public bool $isValid = true,
        public ?string $errorSeverity = null,
        /**
         * @var array<MappedProperty>
         */
        public array $properties = [],
        /**
         * @var array<MappedError>
         */
        public array $errors = [],
        /**
         * Extraction-level warnings: structured-data snippets that were detected but could
         * not be fully parsed. Unlike $errors, these never affect validity — they are
         * informational notices about malformed snippets in a document that was otherwise
         * successfully extracted.
         *
         * @var array<MappedError>
         */
        public array $warnings = [],
        public ?self $parent = null,
        public ?MappedProperty $parentProperty = null,
        /**
         * @var array<self>
         */
        public array $children = [],
        /**
         * @var array<Range>
         */
        public array $keyRanges = [],
        /**
         * @var array<Range>
         */
        public array $valueRanges = [],
        /**
         * @var array<string>
         */
        public array $isPartOf = [],
        /**
         * @var array<string>
         */
        public array $source = [],
    ) {
    }

    public function addKeyRange(Range $range): void
    {
        if (!\in_array($range, $this->keyRanges, true)) {
            $this->keyRanges[] = $range;
        }
    }

    public function addValueRange(Range $range): void
    {
        if (!\in_array($range, $this->valueRanges, true)) {
            $this->valueRanges[] = $range;
        }
    }

    public function getProperty(string $name): ?MappedProperty
    {
        return $this->properties[$name] ?? null;
    }

    /**
     * @return string[]
     */
    public function getErrorMessages(bool $withKey = false): array
    {
        return array_map(
            static function (MappedError $error) use ($withKey) {
                if ($withKey) {
                    $errorKeyPath = $error->getKeyPath();

                    return $errorKeyPath ? $error->getKeyPath() . ': ' . $error->message : $error->message;
                }

                return $error->message;
            },
            $this->errors,
        );
    }

    public function getKeyPath(): ?string
    {
        return $this->parentProperty?->getKeyPath() ?? null;
    }
}
