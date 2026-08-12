<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type;

use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PaymentStatusTypeModel
{
    public const DESCRIPTION = 'A specific payment status. For example, PaymentDue, PaymentComplete, etc.';
    public const LABEL = 'PaymentStatusType';
    public const NAME = 'schema:PaymentStatusType';
    public const PARENTS = ['StatusEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StatusEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['PaymentAutomaticallyAppliedModel' => 'EnumerationMember\PaymentAutomaticallyAppliedModel', 'PaymentCompleteModel' => 'EnumerationMember\PaymentCompleteModel', 'PaymentDeclinedModel' => 'EnumerationMember\PaymentDeclinedModel', 'PaymentDueModel' => 'EnumerationMember\PaymentDueModel', 'PaymentPastDueModel' => 'EnumerationMember\PaymentPastDueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

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
