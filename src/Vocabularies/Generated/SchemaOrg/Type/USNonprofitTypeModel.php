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

final class USNonprofitTypeModel
{
    public const DESCRIPTION = 'USNonprofitType: Non-profit organization type originating from the United States.';
    public const LABEL = 'USNonprofitType';
    public const NAME = 'schema:USNonprofitType';
    public const PARENTS = ['NonprofitTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NonprofitTypeModel'];
    public const ENUMERATION_MEMBERS = ['Nonprofit501aModel' => 'EnumerationMember\Nonprofit501aModel', 'Nonprofit501c10Model' => 'EnumerationMember\Nonprofit501c10Model', 'Nonprofit501c11Model' => 'EnumerationMember\Nonprofit501c11Model', 'Nonprofit501c12Model' => 'EnumerationMember\Nonprofit501c12Model', 'Nonprofit501c13Model' => 'EnumerationMember\Nonprofit501c13Model', 'Nonprofit501c14Model' => 'EnumerationMember\Nonprofit501c14Model', 'Nonprofit501c15Model' => 'EnumerationMember\Nonprofit501c15Model', 'Nonprofit501c16Model' => 'EnumerationMember\Nonprofit501c16Model', 'Nonprofit501c17Model' => 'EnumerationMember\Nonprofit501c17Model', 'Nonprofit501c18Model' => 'EnumerationMember\Nonprofit501c18Model', 'Nonprofit501c19Model' => 'EnumerationMember\Nonprofit501c19Model', 'Nonprofit501c1Model' => 'EnumerationMember\Nonprofit501c1Model', 'Nonprofit501c20Model' => 'EnumerationMember\Nonprofit501c20Model', 'Nonprofit501c21Model' => 'EnumerationMember\Nonprofit501c21Model', 'Nonprofit501c22Model' => 'EnumerationMember\Nonprofit501c22Model', 'Nonprofit501c23Model' => 'EnumerationMember\Nonprofit501c23Model', 'Nonprofit501c24Model' => 'EnumerationMember\Nonprofit501c24Model', 'Nonprofit501c25Model' => 'EnumerationMember\Nonprofit501c25Model', 'Nonprofit501c26Model' => 'EnumerationMember\Nonprofit501c26Model', 'Nonprofit501c27Model' => 'EnumerationMember\Nonprofit501c27Model', 'Nonprofit501c28Model' => 'EnumerationMember\Nonprofit501c28Model', 'Nonprofit501c2Model' => 'EnumerationMember\Nonprofit501c2Model', 'Nonprofit501c3Model' => 'EnumerationMember\Nonprofit501c3Model', 'Nonprofit501c4Model' => 'EnumerationMember\Nonprofit501c4Model', 'Nonprofit501c5Model' => 'EnumerationMember\Nonprofit501c5Model', 'Nonprofit501c6Model' => 'EnumerationMember\Nonprofit501c6Model', 'Nonprofit501c7Model' => 'EnumerationMember\Nonprofit501c7Model', 'Nonprofit501c8Model' => 'EnumerationMember\Nonprofit501c8Model', 'Nonprofit501c9Model' => 'EnumerationMember\Nonprofit501c9Model', 'Nonprofit501dModel' => 'EnumerationMember\Nonprofit501dModel', 'Nonprofit501eModel' => 'EnumerationMember\Nonprofit501eModel', 'Nonprofit501fModel' => 'EnumerationMember\Nonprofit501fModel', 'Nonprofit501kModel' => 'EnumerationMember\Nonprofit501kModel', 'Nonprofit501nModel' => 'EnumerationMember\Nonprofit501nModel', 'Nonprofit501qModel' => 'EnumerationMember\Nonprofit501qModel', 'Nonprofit527Model' => 'EnumerationMember\Nonprofit527Model'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2543'];
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
