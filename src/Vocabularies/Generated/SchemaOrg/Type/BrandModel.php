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

final class BrandModel
{
    public const DESCRIPTION = 'A brand is a name used by an organization or business person for labeling a product, product group, or similar.';
    public const LABEL = 'Brand';
    public const NAME = 'schema:Brand';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LogoModel $logo = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SloganModel $slogan = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
