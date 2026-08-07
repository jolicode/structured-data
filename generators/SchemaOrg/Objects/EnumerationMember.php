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

class EnumerationMember extends AbstractSchemaOrgElement
{
    private function __construct(
        public string $name,
        public string $description,
        public string $label,
        public array $inTypes,
        public string $className,
    ) {
    }

    public static function fromRawData(array $rawType): self
    {
        self::sanitizeEntries($rawType);

        $enumerationMember = new self(
            name: trim(self::stringEntry($rawType, Extractor::KEY_ID)),
            description: trim(self::stringEntry($rawType, Extractor::RDFS_COMMENT)),
            label: trim(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
            inTypes: (array) $rawType[Extractor::KEY_TYPE],
            className: self::getClassName(self::stringEntry($rawType, Extractor::RDFS_LABEL)),
        );

        return self::addSchemaInformation($enumerationMember, $rawType);
    }
}
