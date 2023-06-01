<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\TermDefinition;

class TermDefinition
{
    public function __construct(
        public bool $prefixFlag,
        public bool $protected,
        public bool $reverseProperty,
        public ?string $iriMapping = null,
        public ?string $baseUrl = null,
        public mixed $context = false,
        public ?array $containerMapping = null,
        public string|null|false $directionMapping = false,
        public ?string $indexMapping = null,
        public string|null|false $languageMapping = false,
        public ?string $nestValue = null,
        public ?string $typeMapping = null,
    ) {
    }
}
