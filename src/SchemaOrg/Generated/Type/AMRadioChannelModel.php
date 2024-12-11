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

final class AMRadioChannelModel
{
    public const DESCRIPTION = 'A radio channel that uses AM.';
    public const LABEL = 'AMRadioChannel';
    public const NAME = 'schema:AMRadioChannel';
    public const PARENTS = ['RadioChannelModel' => 'Jolicode\SchemaOrg\Type\RadioChannelModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BroadcastChannelIdModel $broadcastChannelId = null,
        public ?Property\BroadcastFrequencyModel $broadcastFrequency = null,
        public ?Property\BroadcastServiceTierModel $broadcastServiceTier = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\GenreModel $genre = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InBroadcastLineupModel $inBroadcastLineup = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProvidesBroadcastServiceModel $providesBroadcastService = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
