<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition;

final class TermDefinitionDraft
{
    public function __construct(
        public bool $prefixFlag,
        public bool $protected,
        public bool $reverseProperty,
        public ?string $iriMapping = null,
        public ?string $baseUrl = null,
        public mixed $context = false,
        public ?array $containerMapping = null,
        public string|false|null $directionMapping = false,
        public ?string $indexMapping = null,
        public string|false|null $languageMapping = false,
        public ?string $nestValue = null,
        public ?string $typeMapping = null,
    ) {
    }

    public function toTermDefinition(): TermDefinition
    {
        return new TermDefinition(
            prefixFlag: $this->prefixFlag,
            protected: $this->protected,
            reverseProperty: $this->reverseProperty,
            iriMapping: $this->iriMapping,
            baseUrl: $this->baseUrl,
            context: $this->context,
            containerMapping: $this->containerMapping,
            directionMapping: $this->directionMapping,
            indexMapping: $this->indexMapping,
            languageMapping: $this->languageMapping,
            nestValue: $this->nestValue,
            typeMapping: $this->typeMapping,
        );
    }
}
