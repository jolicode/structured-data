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

final class ContentRatingModel
{
    public const DESCRIPTION = 'Official rating of a piece of content&#x2014;for example, \'MPAA PG-13\'.';
    public const LABEL = 'contentRating';
    public const NAME = 'schema:contentRating';
    public const VALUES = ['RatingModel' => 'SchemaOrg\Type\RatingModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
