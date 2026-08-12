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

final class SteeringPositionValueModel
{
    public const DESCRIPTION = 'A value indicating a steering position.';
    public const LABEL = 'SteeringPositionValue';
    public const NAME = 'schema:SteeringPositionValue';
    public const PARENTS = ['QualitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel'];
    public const ENUMERATION_MEMBERS = ['LeftHandDrivingModel' => 'EnumerationMember\LeftHandDrivingModel', 'RightHandDrivingModel' => 'EnumerationMember\RightHandDrivingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EqualModel $equal = null,
        public ?Property\GreaterModel $greater = null,
        public ?Property\GreaterOrEqualModel $greaterOrEqual = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LesserModel $lesser = null,
        public ?Property\LesserOrEqualModel $lesserOrEqual = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NonEqualModel $nonEqual = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueReferenceModel $valueReference = null,
    ) {
    }
}
