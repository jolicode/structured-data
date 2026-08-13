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

final class TravelBansModel
{
    public const DESCRIPTION = 'Information about travel bans, e.g. in the context of a pandemic.';
    public const LABEL = 'travelBans';
    public const NAME = 'schema:travelBans';
    public const VALUES = ['URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel', 'WebContentModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2490'];
    public const SUPERSEDED_BY = null;
}
