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

final class PriceTypeEnumerationModel
{
    public const DESCRIPTION = 'Enumerates different price types, for example list price, invoice price, and sale price.';
    public const LABEL = 'PriceTypeEnumeration';
    public const NAME = 'schema:PriceTypeEnumeration';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['InvoicePriceModel' => 'EnumerationMember\InvoicePriceModel', 'ListPriceModel' => 'EnumerationMember\ListPriceModel', 'MSRPModel' => 'EnumerationMember\MSRPModel', 'MinimumAdvertisedPriceModel' => 'EnumerationMember\MinimumAdvertisedPriceModel', 'RegularPriceModel' => 'EnumerationMember\RegularPriceModel', 'SRPModel' => 'EnumerationMember\SRPModel', 'SalePriceModel' => 'EnumerationMember\SalePriceModel', 'StrikethroughPriceModel' => 'EnumerationMember\StrikethroughPriceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2712'];

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
