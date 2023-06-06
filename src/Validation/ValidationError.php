<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation;

readonly class ValidationError
{
    public function __construct(
        public string $message,
        private ?object $type = null,
    ) {
    }

    public function setType(object $type): void
    {
        $this->type = $type;
    }
}
