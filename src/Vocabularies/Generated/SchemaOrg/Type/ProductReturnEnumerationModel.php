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

final class ProductReturnEnumerationModel
{
    public const DESCRIPTION = 'ProductReturnEnumeration enumerates several kinds of product return policy. Note that this structure may not capture all aspects of the policy.';
    public const LABEL = 'ProductReturnEnumeration';
    public const NAME = 'schema:ProductReturnEnumeration';
    public const PARENTS = ['EnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['ProductReturnFiniteReturnWindowModel' => 'EnumerationMember\ProductReturnFiniteReturnWindowModel', 'ProductReturnNotPermittedModel' => 'EnumerationMember\ProductReturnNotPermittedModel', 'ProductReturnUnlimitedWindowModel' => 'EnumerationMember\ProductReturnUnlimitedWindowModel', 'ProductReturnUnspecifiedModel' => 'EnumerationMember\ProductReturnUnspecifiedModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2288'];
    public const SUPERSEDED_BY = 'MerchantReturnEnumeration';

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
