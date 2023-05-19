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

abstract class AsbtractSchemaOrgElement
{
    abstract public static function fromRawData(array $rawType): self;

    /**
     * The comment and label keys may be an array with a language key, which we don't need.
     *
     * @param array<string, string|array> $rawType
     */
    protected static function removeLanguageKeys(array &$rawType): void
    {
        if (\is_array($rawType[Extractor::RDFS_COMMENT])) {
            $rawType[Extractor::RDFS_COMMENT] = $rawType[Extractor::RDFS_COMMENT][Extractor::KEY_VALUE];
        }

        if (\is_array($rawType[Extractor::RDFS_LABEL])) {
            $rawType[Extractor::RDFS_LABEL] = $rawType[Extractor::RDFS_LABEL][Extractor::KEY_VALUE];
        }
    }
}
