<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser\Properties;

class Property
{
    public function __construct(
        public readonly Key $key,
        public ?Value $value = null,
    ) {
    }
}
