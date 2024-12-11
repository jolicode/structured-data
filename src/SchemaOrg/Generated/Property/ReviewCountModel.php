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

final class ReviewCountModel
{
    public const DESCRIPTION = 'The count of total number of reviews.';
    public const LABEL = 'reviewCount';
    public const NAME = 'schema:reviewCount';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['AggregateRating' => 'Jolicode\SchemaOrg\Type\AggregateRatingModel'];
}
