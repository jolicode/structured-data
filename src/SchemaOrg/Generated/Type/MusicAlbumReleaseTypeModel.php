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

final class MusicAlbumReleaseTypeModel
{
    public const DESCRIPTION = 'The kind of release which this album is: single, EP or album.';
    public const LABEL = 'MusicAlbumReleaseType';
    public const NAME = 'schema:MusicAlbumReleaseType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AlbumReleaseModel' => 'EnumerationMember\AlbumReleaseModel', 'BroadcastReleaseModel' => 'EnumerationMember\BroadcastReleaseModel', 'EPReleaseModel' => 'EnumerationMember\EPReleaseModel', 'SingleReleaseModel' => 'EnumerationMember\SingleReleaseModel'];
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
