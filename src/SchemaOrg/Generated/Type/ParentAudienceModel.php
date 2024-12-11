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

final class ParentAudienceModel
{
    public const DESCRIPTION = 'A set of characteristics describing parents, who can be interested in viewing some content.';
    public const LABEL = 'ParentAudience';
    public const NAME = 'schema:ParentAudience';
    public const PARENTS = ['PeopleAudienceModel' => 'Jolicode\SchemaOrg\Type\PeopleAudienceModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AudienceTypeModel $audienceType = null,
        public ?Property\ChildMaxAgeModel $childMaxAge = null,
        public ?Property\ChildMinAgeModel $childMinAge = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\GeographicAreaModel $geographicArea = null,
        public ?Property\HealthConditionModel $healthCondition = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RequiredGenderModel $requiredGender = null,
        public ?Property\RequiredMaxAgeModel $requiredMaxAge = null,
        public ?Property\RequiredMinAgeModel $requiredMinAge = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SuggestedAgeModel $suggestedAge = null,
        public ?Property\SuggestedGenderModel $suggestedGender = null,
        public ?Property\SuggestedMaxAgeModel $suggestedMaxAge = null,
        public ?Property\SuggestedMeasurementModel $suggestedMeasurement = null,
        public ?Property\SuggestedMinAgeModel $suggestedMinAge = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
