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

final class TypeAndQuantityNodeModel
{
    public const DESCRIPTION = 'A structured value indicating the quantity, unit of measurement, and business function of goods included in a bundle offer.';
    public const LABEL = 'TypeAndQuantityNode';
    public const NAME = 'schema:TypeAndQuantityNode';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AmountOfThisGoodModel $amountOfThisGood = null,
        public ?Property\BusinessFunctionModel $businessFunction = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TypeOfGoodModel $typeOfGood = null,
        public ?Property\UnitCodeModel $unitCode = null,
        public ?Property\UnitTextModel $unitText = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
