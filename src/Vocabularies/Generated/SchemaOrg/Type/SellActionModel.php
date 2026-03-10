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

final class SellActionModel
{
    public const DESCRIPTION = 'The act of taking money from a buyer in exchange for goods or services rendered. An agent sells an object, product, or service to a buyer for a price. Reciprocal of BuyAction.';
    public const LABEL = 'SellAction';
    public const NAME = 'schema:SellAction';
    public const PARENTS = ['TradeActionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TradeActionModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\ActionProcessModel $actionProcess = null,
        public ?Property\ActionStatusModel $actionStatus = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AgentModel $agent = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BuyerModel $buyer = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EndTimeModel $endTime = null,
        public ?Property\ErrorModel $error = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InstrumentModel $instrument = null,
        public ?Property\LocationModel $location = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\ObjectModel $object = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\ParticipantModel $participant = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceModel $price = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\PriceSpecificationModel $priceSpecification = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ResultModel $result = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartTimeModel $startTime = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TargetModel $target = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WarrantyPromiseModel $warrantyPromise = null,
    ) {
    }
}
