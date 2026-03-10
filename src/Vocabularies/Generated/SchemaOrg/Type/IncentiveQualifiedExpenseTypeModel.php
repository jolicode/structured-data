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

final class IncentiveQualifiedExpenseTypeModel
{
    public const DESCRIPTION = 'The types of expenses that are covered by the incentive. For example some incentives are only for the goods (tangible items) but the services (labor) are excluded.';
    public const LABEL = 'IncentiveQualifiedExpenseType';
    public const NAME = 'schema:IncentiveQualifiedExpenseType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['IncentiveQualifiedExpenseTypeGoodsOnlyModel' => 'EnumerationMember\IncentiveQualifiedExpenseTypeGoodsOnlyModel', 'IncentiveQualifiedExpenseTypeGoodsOrServicesModel' => 'EnumerationMember\IncentiveQualifiedExpenseTypeGoodsOrServicesModel', 'IncentiveQualifiedExpenseTypeServicesOnlyModel' => 'EnumerationMember\IncentiveQualifiedExpenseTypeServicesOnlyModel', 'IncentiveQualifiedExpenseTypeUtilityBillModel' => 'EnumerationMember\IncentiveQualifiedExpenseTypeUtilityBillModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];

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
