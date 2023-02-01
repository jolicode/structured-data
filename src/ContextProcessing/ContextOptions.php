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

class ContextOptions
{
    public function __construct(
        /** @var TermDefinition[] $termDefinitions */
        public array $termDefinitions = [],
        public ?string $baseIri = null,
        public ?string $baseUrl = null,
        public ?Context $inverseContext = null,
        public ?string $vocabularyMapping = null,
        public ?string $defaultLangage = null,
        public ?string $defaultBaseDirection = null,
        public ?Context $previousContext = null,
    ) {
    }
}
