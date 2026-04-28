<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class SizeSpecificationModel
{
    public const DESCRIPTION = 'Size related properties of a product, typically a size code ([[name]]) and optionally a [[sizeSystem]], [[sizeGroup]], and product measurements ([[hasMeasurement]]). In addition, the intended audience can be defined through [[suggestedAge]], [[suggestedGender]], and suggested body measurements ([[suggestedMeasurement]]).';
    public const LABEL = 'SizeSpecification';
    public const NAME = 'schema:SizeSpecification';
    public const PARENTS = ['QualitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2811'];

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EqualModel $equal = null,
        public ?Property\GreaterModel $greater = null,
        public ?Property\GreaterOrEqualModel $greaterOrEqual = null,
        public ?Property\HasMeasurementModel $hasMeasurement = null,
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
        public ?Property\SizeGroupModel $sizeGroup = null,
        public ?Property\SizeSystemModel $sizeSystem = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SuggestedAgeModel $suggestedAge = null,
        public ?Property\SuggestedGenderModel $suggestedGender = null,
        public ?Property\SuggestedMeasurementModel $suggestedMeasurement = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueReferenceModel $valueReference = null,
    ) {
    }
}
