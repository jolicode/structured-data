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

use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;

class Type extends AsbtractSchemaOrgElement
{
    private function __construct(
        public string $name,
        public string $description,
        public string $label,
        public array $equivalentClass = [],
        public string $className,

        /**
         * @var array<string>
         */
        public array $parents = [],

        /**
         * @var array<string, Property>
         */
        public array $properties = [],

        /**
         * @var array<string, EnumerationMember>
         */
        public array $enumerationMembers = [],
    ) {
    }

    public static function fromRawData(array $rawType): self
    {
        self::sanitizeEntries($rawType);

        $type = new self(
            name: $rawType[Extractor::KEY_ID],
            description: $rawType[Extractor::RDFS_COMMENT],
            label: $rawType[Extractor::RDFS_LABEL],
            equivalentClass: $rawType[Extractor::OWL_EQUIVALENT_CLASS] ?? [],
            className: self::getClassName($rawType[Extractor::RDFS_LABEL]),
        );

        $parents = $rawType[Extractor::RDFS_SUB_CLASS_OF] ?? null;

        if ($parents) {
            if (\is_array($parents) && \array_key_exists(Extractor::KEY_ID, $parents)) {
                $type->parents[$parents[Extractor::KEY_ID]] = $parents[Extractor::KEY_ID];
            } else {
                foreach ($parents as $parent) {
                    $type->parents[$parent[Extractor::KEY_ID]] = $parent[Extractor::KEY_ID];
                }
            }
        }

        return $type;
    }

    public function addProperty(Property $property): void
    {
        $this->properties[$property->name] = $property;
    }

    public function addEnumerationMember(EnumerationMember $enumerationMember): void
    {
        $this->enumerationMembers[$enumerationMember->name] = $enumerationMember;
    }
}
