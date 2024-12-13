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

final class WorkBasedProgramModel
{
    public const DESCRIPTION = 'A program with both an educational and employment component. Typically based at a workplace and structured around work-based learning, with the aim of instilling competencies related to an occupation. WorkBasedProgram is used to distinguish programs such as apprenticeships from school, college or other classroom based educational programs.';
    public const LABEL = 'WorkBasedProgram';
    public const NAME = 'schema:WorkBasedProgram';
    public const PARENTS = ['EducationalOccupationalProgramModel' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2289'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ApplicationDeadlineModel $applicationDeadline = null,
        public ?Property\ApplicationStartDateModel $applicationStartDate = null,
        public ?Property\DayOfWeekModel $dayOfWeek = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EducationalCredentialAwardedModel $educationalCredentialAwarded = null,
        public ?Property\EducationalProgramModeModel $educationalProgramMode = null,
        public ?Property\EndDateModel $endDate = null,
        public ?Property\FinancialAidEligibleModel $financialAidEligible = null,
        public ?Property\HasCourseModel $hasCourse = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaximumEnrollmentModel $maximumEnrollment = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumberOfCreditsModel $numberOfCredits = null,
        public ?Property\OccupationalCategoryModel $occupationalCategory = null,
        public ?Property\OccupationalCredentialAwardedModel $occupationalCredentialAwarded = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProgramPrerequisitesModel $programPrerequisites = null,
        public ?Property\ProgramTypeModel $programType = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\SalaryUponCompletionModel $salaryUponCompletion = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartDateModel $startDate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TermDurationModel $termDuration = null,
        public ?Property\TermsPerYearModel $termsPerYear = null,
        public ?Property\TimeOfDayModel $timeOfDay = null,
        public ?Property\TimeToCompleteModel $timeToComplete = null,
        public ?Property\TrainingSalaryModel $trainingSalary = null,
        public ?Property\TypicalCreditsPerTermModel $typicalCreditsPerTerm = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
