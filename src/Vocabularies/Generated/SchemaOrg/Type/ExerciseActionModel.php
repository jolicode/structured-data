<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ExerciseActionModel
{
    public const DESCRIPTION = 'The act of participating in exertive activity for the purposes of improving health and fitness.';
    public const LABEL = 'ExerciseAction';
    public const NAME = 'schema:ExerciseAction';
    public const PARENTS = ['PlayActionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlayActionModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\ActionProcessModel $actionProcess = null,
        public ?Property\ActionStatusModel $actionStatus = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AgentModel $agent = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\CourseModel $course = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DietModel $diet = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DistanceModel $distance = null,
        public ?Property\EndTimeModel $endTime = null,
        public ?Property\ErrorModel $error = null,
        public ?Property\EventModel $event = null,
        public ?Property\ExerciseCourseModel $exerciseCourse = null,
        public ?Property\ExercisePlanModel $exercisePlan = null,
        public ?Property\ExerciseRelatedDietModel $exerciseRelatedDiet = null,
        public ?Property\ExerciseTypeModel $exerciseType = null,
        public ?Property\FromLocationModel $fromLocation = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InstrumentModel $instrument = null,
        public ?Property\LocationModel $location = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\ObjectModel $object = null,
        public ?Property\OpponentModel $opponent = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\ParticipantModel $participant = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ResultModel $result = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SportsActivityLocationModel $sportsActivityLocation = null,
        public ?Property\SportsEventModel $sportsEvent = null,
        public ?Property\SportsTeamModel $sportsTeam = null,
        public ?Property\StartTimeModel $startTime = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TargetModel $target = null,
        public ?Property\ToLocationModel $toLocation = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
