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

final class OccupationModel
{
    public const DESCRIPTION = 'A profession, may involve prolonged training and/or a formal qualification.';
    public const LABEL = 'Occupation';
    public const NAME = 'schema:Occupation';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1698'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EducationRequirementsModel $educationRequirements = null,
        public ?Property\EstimatedSalaryModel $estimatedSalary = null,
        public ?Property\ExperienceRequirementsModel $experienceRequirements = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OccupationLocationModel $occupationLocation = null,
        public ?Property\OccupationalCategoryModel $occupationalCategory = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\QualificationsModel $qualifications = null,
        public ?Property\ResponsibilitiesModel $responsibilities = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SkillsModel $skills = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
