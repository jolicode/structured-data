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

final class BodyMeasurementTypeEnumerationModel
{
    public const DESCRIPTION = 'Enumerates types (or dimensions) of a person\'s body measurements, for example for fitting of clothes.';
    public const LABEL = 'BodyMeasurementTypeEnumeration';
    public const NAME = 'schema:BodyMeasurementTypeEnumeration';
    public const PARENTS = ['MeasurementTypeEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MeasurementTypeEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['BodyMeasurementArmModel' => 'EnumerationMember\BodyMeasurementArmModel', 'BodyMeasurementBustModel' => 'EnumerationMember\BodyMeasurementBustModel', 'BodyMeasurementChestModel' => 'EnumerationMember\BodyMeasurementChestModel', 'BodyMeasurementFootModel' => 'EnumerationMember\BodyMeasurementFootModel', 'BodyMeasurementHandModel' => 'EnumerationMember\BodyMeasurementHandModel', 'BodyMeasurementHeadModel' => 'EnumerationMember\BodyMeasurementHeadModel', 'BodyMeasurementHeightModel' => 'EnumerationMember\BodyMeasurementHeightModel', 'BodyMeasurementHipsModel' => 'EnumerationMember\BodyMeasurementHipsModel', 'BodyMeasurementInsideLegModel' => 'EnumerationMember\BodyMeasurementInsideLegModel', 'BodyMeasurementNeckModel' => 'EnumerationMember\BodyMeasurementNeckModel', 'BodyMeasurementUnderbustModel' => 'EnumerationMember\BodyMeasurementUnderbustModel', 'BodyMeasurementWaistModel' => 'EnumerationMember\BodyMeasurementWaistModel', 'BodyMeasurementWeightModel' => 'EnumerationMember\BodyMeasurementWeightModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2811'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
