<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class TelevisionChannelModel
{
    public const DESCRIPTION = 'A unique instance of a television BroadcastService on a CableOrSatelliteService lineup.';
    public const LABEL = 'TelevisionChannel';
    public const NAME = 'schema:TelevisionChannel';
    public const PARENTS = ['BroadcastChannelModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BroadcastChannelModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

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
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProvidesBroadcastServiceModel $providesBroadcastService = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
