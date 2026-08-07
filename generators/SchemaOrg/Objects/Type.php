<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators\SchemaOrg\Objects;

use Jolicode\Vocabularies\Generators\SchemaOrg\Extractor;

class Type extends AbstractSchemaOrgElement
{
    private function __construct(
        public string $name,
        public string $description,
        public string $label,
        public array $equivalentClass,
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
            name: trim(self::stringEntry($rawType, Extractor::KEY_ID)),
            description: trim(self::stringEntry($rawType, Extractor::RDFS_COMMENT)),
            label: trim(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
            equivalentClass: (array) ($rawType[Extractor::OWL_EQUIVALENT_CLASS] ?? []),
            className: self::getClassName(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
        );

        $parents = $rawType[Extractor::RDFS_SUB_CLASS_OF] ?? null;

        if (\is_array($parents) && [] !== $parents) {
            if (\array_key_exists(Extractor::KEY_ID, $parents)) {
                $type->addParent($type, $parents[Extractor::KEY_ID]);
            } else {
                foreach ($parents as $parent) {
                    $type->addParent($type, $parent[Extractor::KEY_ID]);
                }
            }
        }

        return self::addSchemaInformation($type, $rawType);
    }

    public function addProperty(Property $property): void
    {
        $this->properties[$property->name] = $property;
    }

    public function addEnumerationMember(EnumerationMember $enumerationMember): void
    {
        $this->enumerationMembers[$enumerationMember->name] = $enumerationMember;
    }

    /** Schema.org adds references to other vocabularies, but they don't belong to the Schema.org vocabulary so we skip them */
    private function addParent(self $type, string $parent): void
    {
        if (str_starts_with($parent, 'schema:')) {
            $type->parents[$parent] = trim($parent);
        }
    }
}
