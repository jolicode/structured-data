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

final class LegalValueLevelModel
{
    public const DESCRIPTION = 'A list of possible levels for the legal validity of a legislation.';
    public const LABEL = 'LegalValueLevel';
    public const NAME = 'schema:LegalValueLevel';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AuthoritativeLegalValueModel' => 'EnumerationMember\AuthoritativeLegalValueModel', 'DefinitiveLegalValueModel' => 'EnumerationMember\DefinitiveLegalValueModel', 'OfficialLegalValueModel' => 'EnumerationMember\OfficialLegalValueModel', 'UnofficialLegalValueModel' => 'EnumerationMember\UnofficialLegalValueModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];

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
