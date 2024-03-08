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

final class StarRatingModel
{
    public const DESCRIPTION = 'An official rating for a lodging business or food establishment, e.g. from national associations or standards bodies. Use the author property to indicate the rating organization, e.g. as an Organization with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars).';
    public const LABEL = 'starRating';
    public const NAME = 'schema:starRating';
    public const VALUES = ['RatingModel' => 'SchemaOrg\Type\RatingModel'];
    public const TYPES = ['FoodEstablishment' => 'SchemaOrg\Type\FoodEstablishmentModel', 'LodgingBusiness' => 'SchemaOrg\Type\LodgingBusinessModel'];
}
