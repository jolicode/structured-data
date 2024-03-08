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

final class ReviewCountModel
{
    public const DESCRIPTION = 'The count of total number of reviews.';
    public const LABEL = 'reviewCount';
    public const NAME = 'schema:reviewCount';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['AggregateRating' => 'SchemaOrg\\Type\\AggregateRatingModel'];
}
