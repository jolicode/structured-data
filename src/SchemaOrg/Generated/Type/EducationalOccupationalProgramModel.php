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

final class EducationalOccupationalProgramModel
{
    public const DESCRIPTION = 'A program offered by an institution which determines the learning progress to achieve an outcome, usually a credential like a degree or certificate. This would define a discrete set of opportunities (e.g., job, courses) that together constitute a program with a clear start, end, set of requirements, and transition to a new occupational opportunity (e.g., a job), or sometimes a higher educational opportunity (e.g., an advanced degree).';
    public const LABEL = 'EducationalOccupationalProgram';
    public const NAME = 'schema:EducationalOccupationalProgram';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
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
