<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class BestRatingModel
{
    public const DESCRIPTION = 'The highest value allowed in this rating system. If bestRating is omitted, 5 is assumed.';
    public const LABEL = 'bestRating';
    public const NAME = 'schema:bestRating';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Rating' => 'SchemaOrg\Type\RatingModel'];
}
