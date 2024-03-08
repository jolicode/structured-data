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

final class MedicineSystemModel
{
    public const DESCRIPTION = 'Systems of medical practice.';
    public const LABEL = 'MedicineSystem';
    public const NAME = 'schema:MedicineSystem';
    public const PARENTS = ['MedicalEnumerationModel' => 'SchemaOrg\Type\MedicalEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AyurvedicModel' => 'EnumerationMember\AyurvedicModel', 'ChiropracticModel' => 'EnumerationMember\ChiropracticModel', 'HomeopathicModel' => 'EnumerationMember\HomeopathicModel', 'OsteopathicModel' => 'EnumerationMember\OsteopathicModel', 'TraditionalChineseModel' => 'EnumerationMember\TraditionalChineseModel', 'WesternConventionalModel' => 'EnumerationMember\WesternConventionalModel'];

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
