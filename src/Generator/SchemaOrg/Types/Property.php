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

class Property extends AsbtractSchemaOrgElement
{
    private const INCLUDE_DOMAIN = 'schema:domainIncludes';
    private const INCLUDE_RANGE = 'schema:rangeIncludes';

    public function __construct(
        public string $name,
        public string|array $description,
        public string $label,

        /**
         * @var array<string>
         */
        public array $possibleParent,

        /**
         * @var array<string>
         */
        public array $inType,
    ) {
    }

    public static function fromRawData(array $rawType): self
    {
        AsbtractSchemaOrgElement::removeLanguageKeys($rawType);

        $property = new self(
            name: $rawType[Extractor::KEY_ID],
            description: $rawType[Extractor::RDFS_COMMENT],
            label: $rawType[Extractor::RDFS_LABEL],
            possibleParent: self::getPossibleParents($rawType),
            inType: self::getIncludedTypes($rawType),
        );

        return $property;
    }

    private static function getPossibleParents(array $rawType): array
    {
        if (\array_key_exists(self::INCLUDE_RANGE, $rawType)) {
            if (\array_key_exists(Extractor::KEY_ID, $rawType[self::INCLUDE_RANGE])) {
                return [$rawType[self::INCLUDE_RANGE][Extractor::KEY_ID]];
            }

            $possibleParent = [];

            foreach ($rawType[self::INCLUDE_RANGE] as $type) {
                $possibleParent[] = $type[Extractor::KEY_ID];
            }

            return $possibleParent;
        }

        return [];
    }

    private static function getIncludedTypes(array $rawType): array
    {
        if (\array_key_exists(self::INCLUDE_DOMAIN, $rawType)) {
            if (\array_key_exists(Extractor::KEY_ID, $rawType[self::INCLUDE_DOMAIN])) {
                return [$rawType[self::INCLUDE_DOMAIN][Extractor::KEY_ID]];
            }

            $inType = [];

            foreach ($rawType[self::INCLUDE_DOMAIN] as $domain) {
                $inType[] = $domain[Extractor::KEY_ID];
            }

            return $inType;
        }

        return [];
    }
}
