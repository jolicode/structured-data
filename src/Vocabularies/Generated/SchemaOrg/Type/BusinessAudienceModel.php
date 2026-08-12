<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class BusinessAudienceModel
{
    public const DESCRIPTION = 'A set of characteristics belonging to businesses, e.g. who compose an item\'s target audience.';
    public const LABEL = 'BusinessAudience';
    public const NAME = 'schema:BusinessAudience';
    public const PARENTS = ['AudienceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudienceModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AudienceTypeModel $audienceType = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\GeographicAreaModel $geographicArea = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumberOfEmployeesModel $numberOfEmployees = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\YearlyRevenueModel $yearlyRevenue = null,
        public ?Property\YearsInOperationModel $yearsInOperation = null,
    ) {
    }
}
