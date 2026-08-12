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

final class AnnouncementLocationModel
{
    public const DESCRIPTION = 'Indicates a specific [[CivicStructure]] or [[LocalBusiness]] associated with the SpecialAnnouncement. For example, a specific testing facility or business with special opening hours. For a larger geographic region like a quarantine of an entire region, use [[spatialCoverage]].';
    public const LABEL = 'announcementLocation';
    public const NAME = 'schema:announcementLocation';
    public const VALUES = ['CivicStructureModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CivicStructureModel', 'LocalBusinessModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LocalBusinessModel'];
    public const TYPES = ['SpecialAnnouncement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2514'];
    public const SUPERSEDED_BY = null;
}
