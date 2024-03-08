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

final class IsFamilyFriendlyModel
{
    public const DESCRIPTION = 'Indicates whether this content is family friendly.';
    public const LABEL = 'isFamilyFriendly';
    public const NAME = 'schema:isFamilyFriendly';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
