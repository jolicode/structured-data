<?php

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

final class MusicAlbumProductionTypeModel
{
    public const DESCRIPTION = 'Classification of the album by its type of content: soundtrack, live album, studio album, etc.';
    public const LABEL = 'MusicAlbumProductionType';
    public const NAME = 'schema:MusicAlbumProductionType';
    public const PARENTS = ['EnumerationModel' => 'SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['CompilationAlbumModel' => 'EnumerationMember\CompilationAlbumModel', 'DJMixAlbumModel' => 'EnumerationMember\DJMixAlbumModel', 'DemoAlbumModel' => 'EnumerationMember\DemoAlbumModel', 'LiveAlbumModel' => 'EnumerationMember\LiveAlbumModel', 'MixtapeAlbumModel' => 'EnumerationMember\MixtapeAlbumModel', 'RemixAlbumModel' => 'EnumerationMember\RemixAlbumModel', 'SoundtrackAlbumModel' => 'EnumerationMember\SoundtrackAlbumModel', 'SpokenWordAlbumModel' => 'EnumerationMember\SpokenWordAlbumModel', 'StudioAlbumModel' => 'EnumerationMember\StudioAlbumModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
