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

final class PriceComponentTypeEnumerationModel
{
    public const DESCRIPTION = 'Enumerates different price components that together make up the total price for an offered product.';
    public const LABEL = 'PriceComponentTypeEnumeration';
    public const NAME = 'schema:PriceComponentTypeEnumeration';
    public const PARENTS = ['EnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['ActivationFeeModel' => 'EnumerationMember\ActivationFeeModel', 'CleaningFeeModel' => 'EnumerationMember\CleaningFeeModel', 'DistanceFeeModel' => 'EnumerationMember\DistanceFeeModel', 'DownpaymentModel' => 'EnumerationMember\DownpaymentModel', 'InstallmentModel' => 'EnumerationMember\InstallmentModel', 'SubscriptionModel' => 'EnumerationMember\SubscriptionModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2689'];
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
