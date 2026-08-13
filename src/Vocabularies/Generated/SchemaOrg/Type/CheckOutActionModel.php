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

final class CheckOutActionModel
{
    public const DESCRIPTION = 'The act of an agent communicating (service provider, social media, etc) their departure of a previously reserved service (e.g. flight check-in) or place (e.g. hotel).\n\nRelated actions:\n\n* [[CheckInAction]]: The antonym of CheckOutAction.\n* [[DepartAction]]: Unlike DepartAction, CheckOutAction implies that the agent is informing/confirming the end of a previously reserved service.\n* [[CancelAction]]: Unlike CancelAction, CheckOutAction implies that the agent is informing/confirming the end of a previously reserved service.';
    public const LABEL = 'CheckOutAction';
    public const NAME = 'schema:CheckOutAction';
    public const PARENTS = ['CommunicateActionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CommunicateActionModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AboutModel $about = null,
        public ?Property\ActionProcessModel $actionProcess = null,
        public ?Property\ActionStatusModel $actionStatus = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AgentModel $agent = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EndTimeModel $endTime = null,
        public ?Property\ErrorModel $error = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\InstrumentModel $instrument = null,
        public ?Property\LanguageModel $language = null,
        public ?Property\LocationModel $location = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\ObjectModel $object = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\ParticipantModel $participant = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\RecipientModel $recipient = null,
        public ?Property\ResultModel $result = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartTimeModel $startTime = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TargetModel $target = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
