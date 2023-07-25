<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Error;

readonly class ValidationError
{
    public function __construct(
        public string $message,

        public ?string $key,

        /**
         * Since a type may have other types as property values, we need to know the properties names of all the nested types.
         *
         * @var array<string|int>
         */
        public array $propertiesChain,

        public bool $onGraph,

        public int $graphKey,
    ) {
    }
}
