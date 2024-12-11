<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class JobPostingModel
{
    public const DESCRIPTION = 'A listing that describes a job opening in a certain organization.';
    public const LABEL = 'JobPosting';
    public const NAME = 'schema:JobPosting';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ApplicantLocationRequirementsModel $applicantLocationRequirements = null,
        public ?Property\ApplicationContactModel $applicationContact = null,
        public ?Property\BaseSalaryModel $baseSalary = null,
        public ?Property\BenefitsModel $benefits = null,
        public ?Property\DatePostedModel $datePosted = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DirectApplyModel $directApply = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EducationRequirementsModel $educationRequirements = null,
        public ?Property\EligibilityToWorkRequirementModel $eligibilityToWorkRequirement = null,
        public ?Property\EmployerOverviewModel $employerOverview = null,
        public ?Property\EmploymentTypeModel $employmentType = null,
        public ?Property\EmploymentUnitModel $employmentUnit = null,
        public ?Property\EstimatedSalaryModel $estimatedSalary = null,
        public ?Property\ExperienceInPlaceOfEducationModel $experienceInPlaceOfEducation = null,
        public ?Property\ExperienceRequirementsModel $experienceRequirements = null,
        public ?Property\HiringOrganizationModel $hiringOrganization = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IncentiveCompensationModel $incentiveCompensation = null,
        public ?Property\IncentivesModel $incentives = null,
        public ?Property\IndustryModel $industry = null,
        public ?Property\JobBenefitsModel $jobBenefits = null,
        public ?Property\JobImmediateStartModel $jobImmediateStart = null,
        public ?Property\JobLocationModel $jobLocation = null,
        public ?Property\JobLocationTypeModel $jobLocationType = null,
        public ?Property\JobStartDateModel $jobStartDate = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OccupationalCategoryModel $occupationalCategory = null,
        public ?Property\PhysicalRequirementModel $physicalRequirement = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\QualificationsModel $qualifications = null,
        public ?Property\RelevantOccupationModel $relevantOccupation = null,
        public ?Property\ResponsibilitiesModel $responsibilities = null,
        public ?Property\SalaryCurrencyModel $salaryCurrency = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SecurityClearanceRequirementModel $securityClearanceRequirement = null,
        public ?Property\SensoryRequirementModel $sensoryRequirement = null,
        public ?Property\SkillsModel $skills = null,
        public ?Property\SpecialCommitmentsModel $specialCommitments = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TitleModel $title = null,
        public ?Property\TotalJobOpeningsModel $totalJobOpenings = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidThroughModel $validThrough = null,
        public ?Property\WorkHoursModel $workHours = null,
    ) {
    }
}
