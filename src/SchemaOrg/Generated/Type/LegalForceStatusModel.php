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

final class LegalForceStatusModel
{
    public const DESCRIPTION = 'A list of possible statuses for the legal force of a legislation.';
    public const LABEL = 'LegalForceStatus';
    public const NAME = 'schema:LegalForceStatus';
    public const PARENTS = ['StatusEnumerationModel' => 'Jolicode\SchemaOrg\Type\StatusEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['InForceModel' => 'EnumerationMember\InForceModel', 'NotInForceModel' => 'EnumerationMember\NotInForceModel', 'PartiallyInForceModel' => 'EnumerationMember\PartiallyInForceModel'];

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
