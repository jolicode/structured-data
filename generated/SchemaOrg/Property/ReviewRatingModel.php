<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ReviewRatingModel
{
    public const DESCRIPTION = 'The rating given in this review. Note that reviews can themselves be rated. The ```reviewRating``` applies to rating given by the review. The [[aggregateRating]] property applies to the review itself, as a creative work.';
    public const LABEL = 'reviewRating';
    public const NAME = 'schema:reviewRating';
    public const VALUES = ['RatingModel' => 'SchemaOrg\\Type\\RatingModel'];
    public const TYPES = ['Review' => 'SchemaOrg\\Type\\ReviewModel'];
}
