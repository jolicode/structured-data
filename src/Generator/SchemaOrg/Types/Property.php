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

class Property implements SchemaOrgTypeInterface
{
    private const INCLUDE_DOMAIN = 'schema:domainIncludes';
    private const INCLUDE_RANGE = 'schema:rangeIncludes';

    public function __construct(
        public string $name,
        public string|array $description,
        public array $possibleTypes,
        public array $possibleDomains,
    ) {
    }

    public static function fromRawType(array $rawType): SchemaOrgTypeInterface
    {
        $property = new self(
            name: $rawType[Generator::KEY_ID],
            description: $rawType[Generator::RDFS_COMMENT],
            possibleTypes: self::getPossibleTypes($rawType),
            possibleDomains: self::getPossibleDomains($rawType),
        );

        return $property;
    }

    private static function getPossibleTypes(array $rawType): array
    {
        if (\array_key_exists(self::INCLUDE_RANGE, $rawType)) {
            if (\array_key_exists(Generator::KEY_ID, $rawType[self::INCLUDE_RANGE])) {
                return [$rawType[self::INCLUDE_RANGE][Generator::KEY_ID]];
            }

            $possibleTypes = [];

            foreach ($rawType[self::INCLUDE_RANGE] as $type) {
                $possibleTypes[] = $type[Generator::KEY_ID];
            }

            return $possibleTypes;
        }

        return [];
    }

    private static function getPossibleDomains(array $rawType): array
    {
        if (\array_key_exists(self::INCLUDE_DOMAIN, $rawType)) {
            if (\array_key_exists(Generator::KEY_ID, $rawType[self::INCLUDE_DOMAIN])) {
                return [$rawType[self::INCLUDE_DOMAIN][Generator::KEY_ID]];
            }

            $possibleDomains = [];

            foreach ($rawType[self::INCLUDE_DOMAIN] as $domain) {
                $possibleDomains[] = $domain[Generator::KEY_ID];
            }

            return $possibleDomains;
        }

        return [];
    }
}
