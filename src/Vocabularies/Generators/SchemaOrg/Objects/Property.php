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

    public static function fromRawData(array $rawType): self
    {
        self::sanitizeEntries($rawType);

        return new self(
            name: trim($rawType[Extractor::KEY_ID]),
            description: trim($rawType[Extractor::RDFS_COMMENT]),
            label: trim($rawType[Extractor::RDFS_LABEL]),
            possibleTypes: self::findPossibleEntries($rawType, self::INCLUDE_DOMAIN),
            possibleValues: self::findPossibleEntries($rawType, self::INCLUDE_RANGE),
            className: self::getClassName($rawType[Extractor::RDFS_LABEL]),
        );
    }

    private static function findPossibleEntries(array $rawType, string $keyword): array
    {
        if (\array_key_exists($keyword, $rawType)) {
            if (\array_key_exists(Extractor::KEY_ID, $rawType[$keyword])) {
                return [$rawType[$keyword][Extractor::KEY_ID]];
            }

            $values = [];

            foreach ($rawType[$keyword] as $type) {
                $values[] = $type[Extractor::KEY_ID];
            }

            return $values;
        }

        return [];
    }
}
