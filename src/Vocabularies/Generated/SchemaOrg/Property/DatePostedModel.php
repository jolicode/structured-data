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

final class DatePostedModel
{
    public const DESCRIPTION = 'Publication date of an online listing.';
    public const LABEL = 'datePosted';
    public const NAME = 'schema:datePosted';
    public const VALUES = ['DateModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CDCPMDRecord' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CDCPMDRecordModel', 'JobPosting' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel', 'RealEstateListing' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RealEstateListingModel', 'SpecialAnnouncement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2490', 'https://github.com/schemaorg/schemaorg/issues/2521'];
    public const SUPERSEDED_BY = null;
}
