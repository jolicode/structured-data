<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class EnergyStarEnergyEfficiencyEnumerationModel
{
    public const DESCRIPTION = 'Used to indicate whether a product is EnergyStar certified.';
    public const LABEL = 'EnergyStarEnergyEfficiencyEnumeration';
    public const NAME = 'schema:EnergyStarEnergyEfficiencyEnumeration';
    public const PARENTS = ['EnergyEfficiencyEnumerationModel' => 'SchemaOrg\Type\EnergyEfficiencyEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['EnergyStarCertifiedModel' => 'EnumerationMember\EnergyStarCertifiedModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
