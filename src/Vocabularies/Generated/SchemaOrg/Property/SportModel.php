<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class SportModel
{
    public const DESCRIPTION = 'A type of sport (e.g. Baseball).';
    public const LABEL = 'sport';
    public const NAME = 'schema:sport';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['SportsEvent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SportsEventModel', 'SportsOrganization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SportsOrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1951'];
    public const SUPERSEDED_BY = null;
}
