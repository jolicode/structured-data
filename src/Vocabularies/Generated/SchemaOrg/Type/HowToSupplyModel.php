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

final class HowToSupplyModel
{
    public const DESCRIPTION = 'A supply consumed when performing the instructions for how to achieve a result.';
    public const LABEL = 'HowToSupply';
    public const NAME = 'schema:HowToSupply';
    public const PARENTS = ['HowToItemModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HowToItemModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EstimatedCostModel $estimatedCost = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItemModel $item = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NextItemModel $nextItem = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PositionModel $position = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PreviousItemModel $previousItem = null,
        public ?Property\RequiredQuantityModel $requiredQuantity = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
