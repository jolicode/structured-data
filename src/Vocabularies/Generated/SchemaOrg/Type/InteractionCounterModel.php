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

final class InteractionCounterModel
{
    public const DESCRIPTION = 'A summary of how users have interacted with this CreativeWork. In most cases, authors will use a subtype to specify the specific type of interaction.';
    public const LABEL = 'InteractionCounter';
    public const NAME = 'schema:InteractionCounter';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EndTimeModel $endTime = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InteractionServiceModel $interactionService = null,
        public ?Property\InteractionTypeModel $interactionType = null,
        public ?Property\LocationModel $location = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartTimeModel $startTime = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\UserInteractionCountModel $userInteractionCount = null,
    ) {
    }
}
