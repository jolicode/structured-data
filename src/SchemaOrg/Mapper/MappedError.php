<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Mapper;

readonly class MappedError
{
    public const SEVERITY_ERROR = 'error';
    public const SEVERITY_WARNING = 'warning';

    public function __construct(
        public string $message,
        public ?string $key,
        public ?string $type,
        public string $severity,
        public ?string $validatorName,
        public string $ranges,
        public MappedType|MappedProperty|null $parent = null,
    ) {
    }

    public function getKeyPath(): string
    {
        $parentPath = $this->parent?->getKeyPath();

        if ($parentPath) {
            return $parentPath;
        }

        return $this->key ?? '';
    }
}
