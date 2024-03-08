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

final class FestivalModel
{
    public const DESCRIPTION = 'Event type: Festival.';
    public const LABEL = 'Festival';
    public const NAME = 'schema:Festival';
    public const PARENTS = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AboutModel $about = null,
        public ?Property\ActorModel $actor = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AttendeeModel $attendee = null,
        public ?Property\AttendeesModel $attendees = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\ComposerModel $composer = null,
        public ?Property\ContributorModel $contributor = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DirectorModel $director = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DoorTimeModel $doorTime = null,
        public ?Property\DurationModel $duration = null,
        public ?Property\EndDateModel $endDate = null,
        public ?Property\EventAttendanceModeModel $eventAttendanceMode = null,
        public ?Property\EventScheduleModel $eventSchedule = null,
        public ?Property\EventStatusModel $eventStatus = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LocationModel $location = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaximumAttendeeCapacityModel $maximumAttendeeCapacity = null,
        public ?Property\MaximumPhysicalAttendeeCapacityModel $maximumPhysicalAttendeeCapacity = null,
        public ?Property\MaximumVirtualAttendeeCapacityModel $maximumVirtualAttendeeCapacity = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\OrganizerModel $organizer = null,
        public ?Property\PerformerModel $performer = null,
        public ?Property\PerformersModel $performers = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PreviousStartDateModel $previousStartDate = null,
        public ?Property\RecordedInModel $recordedIn = null,
        public ?Property\RemainingAttendeeCapacityModel $remainingAttendeeCapacity = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\StartDateModel $startDate = null,
        public ?Property\SubEventModel $subEvent = null,
        public ?Property\SubEventsModel $subEvents = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SuperEventModel $superEvent = null,
        public ?Property\TranslatorModel $translator = null,
        public ?Property\TypicalAgeRangeModel $typicalAgeRange = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WorkFeaturedModel $workFeatured = null,
        public ?Property\WorkPerformedModel $workPerformed = null,
    ) {
    }
}
