<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg\Types;

use Jolicode\JsonLd\Generator\SchemaOrg\Generator;

class EnumerationMember implements SchemaOrgTypeInterface
{
    public function __construct(
        public string $name,
        public string|array $description,
        public array $enumerationMembers,
    ) {
    }

    public static function fromRawType(array $rawType): SchemaOrgTypeInterface
    {
        return new self(
            name: $rawType[Generator::KEY_ID],
            description: $rawType[Generator::RDFS_COMMENT],
            enumerationMembers: (array) $rawType[Generator::KEY_TYPE],
        );
    }
}
