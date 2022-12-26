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

class Context
{
    public function __construct(
        public mixed $context = [],
        public ContextOptions $options = new ContextOptions(),
    ) {
    }

    public function hasProtectedTermDefinitions(): bool
    {
        foreach ($this->options->termDefinitions as $termDefinition) {
            if ($termDefinition->protected) {
                return true;
            }
        }

        return false;
    }
}
