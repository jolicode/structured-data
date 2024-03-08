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

final class ItemReviewedModel
{
    public const DESCRIPTION = 'The item that is being reviewed/rated.';
    public const LABEL = 'itemReviewed';
    public const NAME = 'schema:itemReviewed';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['AggregateRating' => 'SchemaOrg\\Type\\AggregateRatingModel', 'Review' => 'SchemaOrg\\Type\\ReviewModel'];
}
