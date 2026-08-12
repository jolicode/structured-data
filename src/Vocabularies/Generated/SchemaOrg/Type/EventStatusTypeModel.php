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

final class EventStatusTypeModel
{
    public const DESCRIPTION = 'EventStatusType is an enumeration type whose instances represent several states that an Event may be in.';
    public const LABEL = 'EventStatusType';
    public const NAME = 'schema:EventStatusType';
    public const PARENTS = ['StatusEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StatusEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['EventCancelledModel' => 'EnumerationMember\EventCancelledModel', 'EventMovedOnlineModel' => 'EnumerationMember\EventMovedOnlineModel', 'EventPostponedModel' => 'EnumerationMember\EventPostponedModel', 'EventRescheduledModel' => 'EnumerationMember\EventRescheduledModel', 'EventScheduledModel' => 'EnumerationMember\EventScheduledModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

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
