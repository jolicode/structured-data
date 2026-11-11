<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Objects;

use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Extractor;

class EnumerationMember extends AbstractSchemaOrgElement
{
    private function __construct(
        public string $name,
        public string $description,
        public string $label,
        /**
         * @var list<string>
         */
        public array $inTypes,
        public string $className,
    ) {
    }

    /**
     * @param array<mixed> $rawType
     */
    public static function fromRawData(array $rawType): self
    {
        self::sanitizeEntries($rawType);
        $inTypes = [];

        foreach ((array) $rawType[Extractor::KEY_TYPE] as $inType) {
            if (!\is_string($inType)) {
                throw new \InvalidArgumentException('The "@type" entries of a raw schema.org enumeration member must be strings.');
            }

            $inTypes[] = $inType;
        }

        $enumerationMember = new self(
            name: trim(self::stringEntry($rawType, Extractor::KEY_ID)),
            description: trim(self::stringEntry($rawType, Extractor::RDFS_COMMENT)),
            label: trim(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
            inTypes: $inTypes,
            className: self::getClassName(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
        );

        return self::addSchemaInformation($enumerationMember, $rawType);
    }
}
