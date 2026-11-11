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

class Property extends AbstractSchemaOrgElement
{
    private const INCLUDE_DOMAIN = 'schema:domainIncludes';
    private const INCLUDE_RANGE = 'schema:rangeIncludes';

    private function __construct(
        public string $name,
        public string $description,
        public string $label,
        public string $className,
        /**
         * @var array<string>
         */
        public array $possibleTypes,
        /**
         * @var array<string>
         */
        public array $possibleValues,
    ) {
    }

    /**
     * @param array<mixed> $rawType
     */
    public static function fromRawData(array $rawType): self
    {
        self::sanitizeEntries($rawType);

        $property = new self(
            name: trim(self::stringEntry($rawType, Extractor::KEY_ID)),
            description: trim(self::stringEntry($rawType, Extractor::RDFS_COMMENT)),
            label: trim(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
            possibleTypes: self::findPossibleEntries($rawType, self::INCLUDE_DOMAIN),
            possibleValues: self::findPossibleEntries($rawType, self::INCLUDE_RANGE),
            className: self::getClassName(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
        );

        return self::addSchemaInformation($property, $rawType);
    }

    /**
     * @param array<mixed> $rawType
     *
     * @return list<string>
     */
    private static function findPossibleEntries(array $rawType, string $keyword): array
    {
        if (!\array_key_exists($keyword, $rawType)) {
            return [];
        }

        return self::schemaInformationAsArray($rawType[$keyword]);
    }
}
