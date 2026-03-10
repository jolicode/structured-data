<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg\Objects;

use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;

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
            name: trim($rawType[Extractor::KEY_ID]),
            description: trim($rawType[Extractor::RDFS_COMMENT]),
            label: trim($rawType[Extractor::RDFS_LABEL]),
            equivalentClass: $rawType[Extractor::OWL_EQUIVALENT_CLASS] ?? [],
            className: self::getClassName($rawType[Extractor::RDFS_LABEL]),
        );

        $parents = $rawType[Extractor::RDFS_SUB_CLASS_OF] ?? null;

        if ($parents) {
            if (\array_key_exists(Extractor::KEY_ID, $parents)) {
                $type->addParent($parents[Extractor::KEY_ID]);
            } else {
                foreach ($parents as $parent) {
                    $type->addParent($parent[Extractor::KEY_ID]);
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
    private function addParent(string $parent): void
    {
        if (str_starts_with($parent, 'schema:')) {
            $this->parents[$parent] = $parent;
        }
    }
}
