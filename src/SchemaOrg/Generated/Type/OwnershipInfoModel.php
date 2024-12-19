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

final class OwnershipInfoModel
{
    public const DESCRIPTION = 'A structured value providing information about when a certain organization or person owned a certain product.';
    public const LABEL = 'OwnershipInfo';
    public const NAME = 'schema:OwnershipInfo';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AcquiredFromModel $acquiredFrom = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnedFromModel $ownedFrom = null,
        public ?Property\OwnedThroughModel $ownedThrough = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TypeOfGoodModel $typeOfGood = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
