<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class DatePostedModel
{
    public const DESCRIPTION = 'Publication date of an online listing.';
    public const LABEL = 'datePosted';
    public const NAME = 'schema:datePosted';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\SchemaOrg\Type\CDCPMDRecordModel', 'JobPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\JobPostingModel', 'RealEstateListing' => 'Jolicode\Vocabularies\SchemaOrg\Type\RealEstateListingModel', 'SpecialAnnouncement' => 'Jolicode\Vocabularies\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
