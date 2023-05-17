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

class Type implements SchemaOrgTypeInterface
{
    public function __construct(
        public string $name,
        public string|array $description,
        public array $parents = [],
    ) {
    }

    public static function fromRawType(array $rawType): SchemaOrgTypeInterface
    {
        $type = new self(
            name: $rawType[Generator::KEY_ID],
            description: $rawType[Generator::RDFS_COMMENT],
        );

        if ($parents = $rawType[Generator::RDFS_SUB_CLASS_OF] ?? null) {
            if (\array_key_exists(Generator::KEY_ID, $parents)) {
                $type->parents[] = $parents[Generator::KEY_ID];
            } else {
                foreach ($parents as $parent) {
                    $type->$parents[] = $parent[Generator::KEY_ID];
                }
            }
        }

        return $type;
    }
}
