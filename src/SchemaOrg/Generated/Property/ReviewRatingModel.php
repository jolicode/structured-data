<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ReviewRatingModel
{
    public const DESCRIPTION = 'The rating given in this review. Note that reviews can themselves be rated. The ```reviewRating``` applies to rating given by the review. The [[aggregateRating]] property applies to the review itself, as a creative work.';
    public const LABEL = 'reviewRating';
    public const NAME = 'schema:reviewRating';
    public const VALUES = ['RatingModel' => 'Jolicode\SchemaOrg\Type\RatingModel'];
    public const TYPES = ['Review' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
