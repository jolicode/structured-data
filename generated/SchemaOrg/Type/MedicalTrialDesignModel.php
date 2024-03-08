<?php

declare(strict_types=1);

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

final class MedicalTrialDesignModel
{
    public const DESCRIPTION = 'Design models for medical trials. Enumerated type.';
    public const LABEL = 'MedicalTrialDesign';
    public const NAME = 'schema:MedicalTrialDesign';
    public const PARENTS = ['MedicalEnumerationModel' => 'SchemaOrg\\Type\\MedicalEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['DoubleBlindedTrialModel' => 'EnumerationMember\\DoubleBlindedTrialModel', 'InternationalTrialModel' => 'EnumerationMember\\InternationalTrialModel', 'MultiCenterTrialModel' => 'EnumerationMember\\MultiCenterTrialModel', 'OpenTrialModel' => 'EnumerationMember\\OpenTrialModel', 'PlaceboControlledTrialModel' => 'EnumerationMember\\PlaceboControlledTrialModel', 'RandomizedTrialModel' => 'EnumerationMember\\RandomizedTrialModel', 'SingleBlindedTrialModel' => 'EnumerationMember\\SingleBlindedTrialModel', 'SingleCenterTrialModel' => 'EnumerationMember\\SingleCenterTrialModel', 'TripleBlindedTrialModel' => 'EnumerationMember\\TripleBlindedTrialModel'];

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
