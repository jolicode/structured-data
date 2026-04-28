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

final class WearableMeasurementTypeEnumerationModel
{
    public const DESCRIPTION = 'Enumerates common types of measurement for wearables products.';
    public const LABEL = 'WearableMeasurementTypeEnumeration';
    public const NAME = 'schema:WearableMeasurementTypeEnumeration';
    public const PARENTS = ['MeasurementTypeEnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MeasurementTypeEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['WearableMeasurementBackModel' => 'EnumerationMember\WearableMeasurementBackModel', 'WearableMeasurementChestOrBustModel' => 'EnumerationMember\WearableMeasurementChestOrBustModel', 'WearableMeasurementCollarModel' => 'EnumerationMember\WearableMeasurementCollarModel', 'WearableMeasurementCupModel' => 'EnumerationMember\WearableMeasurementCupModel', 'WearableMeasurementHeightModel' => 'EnumerationMember\WearableMeasurementHeightModel', 'WearableMeasurementHipsModel' => 'EnumerationMember\WearableMeasurementHipsModel', 'WearableMeasurementInseamModel' => 'EnumerationMember\WearableMeasurementInseamModel', 'WearableMeasurementLengthModel' => 'EnumerationMember\WearableMeasurementLengthModel', 'WearableMeasurementOutsideLegModel' => 'EnumerationMember\WearableMeasurementOutsideLegModel', 'WearableMeasurementSleeveModel' => 'EnumerationMember\WearableMeasurementSleeveModel', 'WearableMeasurementWaistModel' => 'EnumerationMember\WearableMeasurementWaistModel', 'WearableMeasurementWidthModel' => 'EnumerationMember\WearableMeasurementWidthModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2811'];

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
