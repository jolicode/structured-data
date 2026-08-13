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

final class ActionAccessSpecificationModel
{
    public const DESCRIPTION = 'A set of requirements that must be fulfilled in order to perform an Action.';
    public const LABEL = 'ActionAccessSpecification';
    public const NAME = 'schema:ActionAccessSpecification';
    public const PARENTS = ['IntangibleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1741'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AvailabilityEndsModel $availabilityEnds = null,
        public ?Property\AvailabilityStartsModel $availabilityStarts = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EligibleRegionModel $eligibleRegion = null,
        public ?Property\ExpectsAcceptanceOfModel $expectsAcceptanceOf = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IneligibleRegionModel $ineligibleRegion = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RequiresSubscriptionModel $requiresSubscription = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
