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

final class ItemAvailabilityModel
{
    public const DESCRIPTION = 'A list of possible product availability options.';
    public const LABEL = 'ItemAvailability';
    public const NAME = 'schema:ItemAvailability';
    public const PARENTS = ['EnumerationModel' => 'SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['BackOrderModel' => 'EnumerationMember\BackOrderModel', 'DiscontinuedModel' => 'EnumerationMember\DiscontinuedModel', 'InStockModel' => 'EnumerationMember\InStockModel', 'InStoreOnlyModel' => 'EnumerationMember\InStoreOnlyModel', 'LimitedAvailabilityModel' => 'EnumerationMember\LimitedAvailabilityModel', 'OnlineOnlyModel' => 'EnumerationMember\OnlineOnlyModel', 'OutOfStockModel' => 'EnumerationMember\OutOfStockModel', 'PreOrderModel' => 'EnumerationMember\PreOrderModel', 'PreSaleModel' => 'EnumerationMember\PreSaleModel', 'SoldOutModel' => 'EnumerationMember\SoldOutModel'];

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
