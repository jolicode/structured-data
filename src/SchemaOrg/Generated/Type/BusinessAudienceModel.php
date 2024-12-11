<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class BusinessAudienceModel
{
    public const DESCRIPTION = 'A set of characteristics belonging to businesses, e.g. who compose an item\'s target audience.';
    public const LABEL = 'BusinessAudience';
    public const NAME = 'schema:BusinessAudience';
    public const PARENTS = ['AudienceModel' => 'Jolicode\SchemaOrg\Type\AudienceModel'];
    public const ENUMERATION_MEMBERS = [];

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
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\YearlyRevenueModel $yearlyRevenue = null,
        public ?Property\YearsInOperationModel $yearsInOperation = null,
    ) {
    }
}
