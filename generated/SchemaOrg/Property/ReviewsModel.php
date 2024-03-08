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

final class ReviewsModel
{
    public const DESCRIPTION = 'Review of the item.';
    public const LABEL = 'reviews';
    public const NAME = 'schema:reviews';
    public const VALUES = ['ReviewModel' => 'SchemaOrg\\Type\\ReviewModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
