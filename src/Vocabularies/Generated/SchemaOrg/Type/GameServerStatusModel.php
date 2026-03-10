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

final class GameServerStatusModel
{
    public const DESCRIPTION = 'Status of a game server.';
    public const LABEL = 'GameServerStatus';
    public const NAME = 'schema:GameServerStatus';
    public const PARENTS = ['StatusEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatusEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['OfflinePermanentlyModel' => 'EnumerationMember\OfflinePermanentlyModel', 'OfflineTemporarilyModel' => 'EnumerationMember\OfflineTemporarilyModel', 'OnlineFullModel' => 'EnumerationMember\OnlineFullModel', 'OnlineModel' => 'EnumerationMember\OnlineModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];

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
