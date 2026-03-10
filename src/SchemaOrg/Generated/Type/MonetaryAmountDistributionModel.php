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

final class MonetaryAmountDistributionModel
{
    public const DESCRIPTION = 'A statistical distribution of monetary amounts.';
    public const LABEL = 'MonetaryAmountDistribution';
    public const NAME = 'schema:MonetaryAmountDistribution';
    public const PARENTS = ['QuantitativeValueDistributionModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueDistributionModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1698'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CurrencyModel $currency = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DurationModel $duration = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MedianModel $median = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\Percentile10Model $percentile10 = null,
        public ?Property\Percentile25Model $percentile25 = null,
        public ?Property\Percentile75Model $percentile75 = null,
        public ?Property\Percentile90Model $percentile90 = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
