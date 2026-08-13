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

final class WearableSizeSystemEnumerationModel
{
    public const DESCRIPTION = 'Enumerates common size systems specific for wearable products.';
    public const LABEL = 'WearableSizeSystemEnumeration';
    public const NAME = 'schema:WearableSizeSystemEnumeration';
    public const PARENTS = ['SizeSystemEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SizeSystemEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['WearableSizeSystemAUModel' => 'EnumerationMember\WearableSizeSystemAUModel', 'WearableSizeSystemBRModel' => 'EnumerationMember\WearableSizeSystemBRModel', 'WearableSizeSystemCNModel' => 'EnumerationMember\WearableSizeSystemCNModel', 'WearableSizeSystemContinentalModel' => 'EnumerationMember\WearableSizeSystemContinentalModel', 'WearableSizeSystemDEModel' => 'EnumerationMember\WearableSizeSystemDEModel', 'WearableSizeSystemEN13402Model' => 'EnumerationMember\WearableSizeSystemEN13402Model', 'WearableSizeSystemEuropeModel' => 'EnumerationMember\WearableSizeSystemEuropeModel', 'WearableSizeSystemFRModel' => 'EnumerationMember\WearableSizeSystemFRModel', 'WearableSizeSystemGS1Model' => 'EnumerationMember\WearableSizeSystemGS1Model', 'WearableSizeSystemITModel' => 'EnumerationMember\WearableSizeSystemITModel', 'WearableSizeSystemJPModel' => 'EnumerationMember\WearableSizeSystemJPModel', 'WearableSizeSystemMXModel' => 'EnumerationMember\WearableSizeSystemMXModel', 'WearableSizeSystemUKModel' => 'EnumerationMember\WearableSizeSystemUKModel', 'WearableSizeSystemUSModel' => 'EnumerationMember\WearableSizeSystemUSModel'];
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
