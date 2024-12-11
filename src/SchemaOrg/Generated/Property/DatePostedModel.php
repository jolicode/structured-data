<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class DatePostedModel
{
    public const DESCRIPTION = 'Publication date of an online listing.';
    public const LABEL = 'datePosted';
    public const NAME = 'schema:datePosted';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\SchemaOrg\Type\CDCPMDRecordModel', 'JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel', 'RealEstateListing' => 'Jolicode\SchemaOrg\Type\RealEstateListingModel', 'SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
}
