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

abstract class AbstractSchemaOrgElement
{
    public array $isPartOf = [];
    public array $source = [];

    /**
     * Short label of the term schema.org designates as replacing this one
     * (schema:supersededBy), or null when the term is current.
     */
    public ?string $supersededBy = null;

    /**
     * Instantiates a new object from a fetched Schema.org raw type.
     */
    abstract public static function fromRawData(array $rawType): self;

    public static function getClassName(string $label): string
    {
        return ucfirst(self::replaceStartNumbers(self::removeSchemaPrefix(trim($label)))) . 'Model';
    }

    public static function removeSchemaPrefix(string $name): string
    {
        return str_replace('schema:', '', $name);
    }

    /**
     * Returns a raw type entry that sanitizeEntries() guarantees to be a string.
     */
    protected static function stringEntry(array $rawType, string $key): string
    {
        $value = $rawType[$key];

        if (!\is_string($value)) {
            throw new \InvalidArgumentException(\sprintf('The "%s" entry of the raw schema.org type is not a string.', $key));
        }

        return $value;
    }

    /**
     * @template T of self
     *
     * @param T $object
     *
     * @return T
     */
    protected static function addSchemaInformation(self $object, array $rawType): self
    {
        if (isset($rawType[Extractor::SCHEMA_IS_PART_OF])) {
            $object->isPartOf = self::schemaInformationAsArray($rawType[Extractor::SCHEMA_IS_PART_OF]);
        }

        if (isset($rawType[Extractor::SCHEMA_SOURCE])) {
            $object->source = self::schemaInformationAsArray($rawType[Extractor::SCHEMA_SOURCE]);
        }

        if (isset($rawType[Extractor::SCHEMA_SUPERSEDED_BY])) {
            $supersededBy = self::schemaInformationAsArray($rawType[Extractor::SCHEMA_SUPERSEDED_BY]);

            if (isset($supersededBy[0])) {
                $object->supersededBy = self::removeSchemaPrefix($supersededBy[0]);
            }
        }

        return $object;
    }

    /**
     * The comment and label keys may be an array with a language key, which we don't need.
     *
     * @param array<string, string|array> $rawType
     */
    protected static function sanitizeEntries(array &$rawType): void
    {
        if (\array_key_exists(Extractor::RDFS_COMMENT, $rawType) && \is_array($rawType[Extractor::RDFS_COMMENT])) {
            // @phpstan-ignore parameterByRef.type
            $rawType[Extractor::RDFS_COMMENT] = $rawType[Extractor::RDFS_COMMENT][Extractor::KEY_VALUE];
        }

        if (\array_key_exists(Extractor::RDFS_LABEL, $rawType) && \is_array($rawType[Extractor::RDFS_LABEL])) {
            // @phpstan-ignore parameterByRef.type
            $rawType[Extractor::RDFS_LABEL] = $rawType[Extractor::RDFS_LABEL][Extractor::KEY_VALUE];
        }
    }

    private static function replaceStartNumbers(string $name): string
    {
        if (preg_match('/^(\d+).*$/', $name)) {
            $name = strtr($name, [
                '0' => 'Zero',
                '1' => 'One',
                '2' => 'Two',
                '3' => 'Three',
                '4' => 'Four',
                '5' => 'Five',
                '6' => 'Six',
                '7' => 'Seven',
                '8' => 'Eight',
                '9' => 'Nine',
            ]);
        }

        return $name;
    }

    private static function schemaInformationAsArray(array $schemaInformation): array
    {
        if (isset($schemaInformation[Extractor::KEY_ID])) {
            return [$schemaInformation[Extractor::KEY_ID]];
        }

        return array_map(
            static fn (array $schema) => $schema[Extractor::KEY_ID],
            $schemaInformation,
        );
    }
}
