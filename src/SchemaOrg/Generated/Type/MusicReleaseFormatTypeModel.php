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

final class MusicReleaseFormatTypeModel
{
    public const DESCRIPTION = 'Format of this release (the type of recording media used, i.e. compact disc, digital media, LP, etc.).';
    public const LABEL = 'MusicReleaseFormatType';
    public const NAME = 'schema:MusicReleaseFormatType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['CDFormatModel' => 'EnumerationMember\CDFormatModel', 'CassetteFormatModel' => 'EnumerationMember\CassetteFormatModel', 'DVDFormatModel' => 'EnumerationMember\DVDFormatModel', 'DigitalAudioTapeFormatModel' => 'EnumerationMember\DigitalAudioTapeFormatModel', 'DigitalFormatModel' => 'EnumerationMember\DigitalFormatModel', 'LaserDiscFormatModel' => 'EnumerationMember\LaserDiscFormatModel', 'VinylFormatModel' => 'EnumerationMember\VinylFormatModel'];

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
