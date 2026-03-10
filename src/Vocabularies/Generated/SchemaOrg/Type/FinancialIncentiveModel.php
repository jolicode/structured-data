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

final class FinancialIncentiveModel
{
    public const DESCRIPTION = '<p>Represents financial incentives for goods/services offered by an organization (or individual).</p>

<p>Typically contains the [[name]] of the incentive, the [[incentivizedItem]], the [[incentiveAmount]], the [[incentiveStatus]], [[incentiveType]], the [[provider]] of the incentive, and [[eligibleWithSupplier]].</p>

<p>Optionally contains criteria on whether the incentive is limited based on [[purchaseType]], [[purchasePriceLimit]], [[incomeLimit]], and the [[qualifiedExpense]].';
    public const LABEL = 'FinancialIncentive';
    public const NAME = 'schema:FinancialIncentive';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EligibleWithSupplierModel $eligibleWithSupplier = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IncentiveAmountModel $incentiveAmount = null,
        public ?Property\IncentiveStatusModel $incentiveStatus = null,
        public ?Property\IncentiveTypeModel $incentiveType = null,
        public ?Property\IncentivizedItemModel $incentivizedItem = null,
        public ?Property\IncomeLimitModel $incomeLimit = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\PublisherModel $publisher = null,
        public ?Property\PurchasePriceLimitModel $purchasePriceLimit = null,
        public ?Property\PurchaseTypeModel $purchaseType = null,
        public ?Property\QualifiedExpenseModel $qualifiedExpense = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValidFromModel $validFrom = null,
        public ?Property\ValidThroughModel $validThrough = null,
    ) {
    }
}
