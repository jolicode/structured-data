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

final class WorstRatingModel
{
    public const DESCRIPTION = 'The lowest value allowed in this rating system. If worstRating is omitted, 1 is assumed.';
    public const LABEL = 'worstRating';
    public const NAME = 'schema:worstRating';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Rating' => 'SchemaOrg\\Type\\RatingModel'];
}
