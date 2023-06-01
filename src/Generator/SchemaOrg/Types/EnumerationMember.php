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

class EnumerationMember extends AsbtractSchemaOrgElement
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

        return new self(
            name: $rawType[Extractor::KEY_ID],
            description: $rawType[Extractor::RDFS_COMMENT],
            label: $rawType[Extractor::RDFS_LABEL],
            inTypes: (array) $rawType[Extractor::KEY_TYPE],
            className: self::getClassName($rawType[Extractor::RDFS_LABEL]),
        );
    }
}
