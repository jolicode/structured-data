<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\ContextProcessing;

use Jolicode\JsonLd\TermDefinition\TermDefinition;

class Context
{
    public const PROCESSING_MODE_10 = '1.0';
    public const PROCESSING_MODE_11 = '1.1';

    public function __construct(
        /** @var TermDefinition[] $termDefinitions */
        public array $termDefinitions = [],
        public ?string $baseIri = null,
        public ?string $baseUrl = null,
        public ?self $inverseContext = null,
        public ?string $vocabularyMapping = null,
        public ?string $defaultLangage = null,
        public ?string $defaultBaseDirection = null,
        public ?self $previousContext = null,
        public ?string $processingMode = self::PROCESSING_MODE_11,
    ) {
    }

    public function hasProtectedTermDefinitions(): bool
    {
        /** @var TermDefinition $termDefinition */
        foreach ($this->termDefinitions as $termDefinition) {
            if ($termDefinition->protected) {
                return true;
            }
        }

        return false;
    }
}
