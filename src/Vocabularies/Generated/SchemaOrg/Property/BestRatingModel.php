<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BestRatingModel
{
    public const DESCRIPTION = 'The highest value allowed in this rating system.';
    public const LABEL = 'bestRating';
    public const NAME = 'schema:bestRating';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Rating' => 'Jolicode\Vocabularies\SchemaOrg\Type\RatingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
