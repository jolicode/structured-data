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

final class WorstRatingModel
{
    public const DESCRIPTION = 'The lowest value allowed in this rating system. If worstRating is omitted, 1 is assumed.';
    public const LABEL = 'worstRating';
    public const NAME = 'schema:worstRating';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Rating' => 'Jolicode\SchemaOrg\Type\RatingModel'];
}
