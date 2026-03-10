<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Type;

use Jolicode\Vocabularies\SchemaOrg\Property;

final class RestrictedDietModel
{
    public const DESCRIPTION = 'A diet restricted to certain foods or preparations for cultural, religious, health or lifestyle reasons.';
    public const LABEL = 'RestrictedDiet';
    public const NAME = 'schema:RestrictedDiet';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['DiabeticDietModel' => 'EnumerationMember\DiabeticDietModel', 'GlutenFreeDietModel' => 'EnumerationMember\GlutenFreeDietModel', 'HalalDietModel' => 'EnumerationMember\HalalDietModel', 'HinduDietModel' => 'EnumerationMember\HinduDietModel', 'KosherDietModel' => 'EnumerationMember\KosherDietModel', 'LowCalorieDietModel' => 'EnumerationMember\LowCalorieDietModel', 'LowFatDietModel' => 'EnumerationMember\LowFatDietModel', 'LowLactoseDietModel' => 'EnumerationMember\LowLactoseDietModel', 'LowSaltDietModel' => 'EnumerationMember\LowSaltDietModel', 'VeganDietModel' => 'EnumerationMember\VeganDietModel', 'VegetarianDietModel' => 'EnumerationMember\VegetarianDietModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];

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
