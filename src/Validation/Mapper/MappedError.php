<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Mapper;

use Jolicode\JsonLd\Parser\Range;

readonly class MappedError
{
    public function __construct(
        public string $message,
        public ?string $key,
        public Range $range,
        public string $severity,
    ) {
    }
}
