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

final class DENonprofitTypeModel
{
    public const DESCRIPTION = 'DENonprofitType: Non-profit organization type originating from Germany in accordance with article 52 of the German fiscal code (Abgabenverordnung or AO).';
    public const LABEL = 'DENonprofitType';
    public const NAME = 'schema:DENonprofitType';
    public const PARENTS = ['NonprofitTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NonprofitTypeModel'];
    public const ENUMERATION_MEMBERS = ['DECooperativeCharityModel' => 'EnumerationMember\DECooperativeCharityModel', 'DEFoundationCharityModel' => 'EnumerationMember\DEFoundationCharityModel', 'DEJointStockCompanyCharityModel' => 'EnumerationMember\DEJointStockCompanyCharityModel', 'DELimitedLiabilityCharityModel' => 'EnumerationMember\DELimitedLiabilityCharityModel', 'DENotRegisteredAssociationCharityModel' => 'EnumerationMember\DENotRegisteredAssociationCharityModel', 'DEPublicCharityModel' => 'EnumerationMember\DEPublicCharityModel', 'DERegisteredAssociationCharityModel' => 'EnumerationMember\DERegisteredAssociationCharityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3629'];
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
