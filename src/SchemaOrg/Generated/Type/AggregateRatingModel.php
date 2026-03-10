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

final class AggregateRatingModel
{
    public const DESCRIPTION = 'The average rating based on multiple ratings or reviews.';
    public const LABEL = 'AggregateRating';
    public const NAME = 'schema:AggregateRating';
    public const PARENTS = ['RatingModel' => 'Jolicode\SchemaOrg\Type\RatingModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AuthorModel $author = null,
        public ?Property\BestRatingModel $bestRating = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\ItemReviewedModel $itemReviewed = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RatingCountModel $ratingCount = null,
        public ?Property\RatingExplanationModel $ratingExplanation = null,
        public ?Property\RatingValueModel $ratingValue = null,
        public ?Property\ReviewAspectModel $reviewAspect = null,
        public ?Property\ReviewCountModel $reviewCount = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\WorstRatingModel $worstRating = null,
    ) {
    }
}
