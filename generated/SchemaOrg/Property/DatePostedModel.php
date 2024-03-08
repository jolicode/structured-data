<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DatePostedModel
{
    public const DESCRIPTION = 'Publication date of an online listing.';
    public const LABEL = 'datePosted';
    public const NAME = 'schema:datePosted';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\Type\CDCPMDRecordModel', 'JobPosting' => 'SchemaOrg\Type\JobPostingModel', 'RealEstateListing' => 'SchemaOrg\Type\RealEstateListingModel', 'SpecialAnnouncement' => 'SchemaOrg\Type\SpecialAnnouncementModel'];
}
