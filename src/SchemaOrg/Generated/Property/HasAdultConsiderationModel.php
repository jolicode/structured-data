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

final class HasAdultConsiderationModel
{
    public const DESCRIPTION = 'Used to tag an item to be intended or suitable for consumption or use by adults only.';
    public const LABEL = 'hasAdultConsideration';
    public const NAME = 'schema:hasAdultConsideration';
    public const VALUES = ['AdultOrientedEnumerationModel' => 'Jolicode\SchemaOrg\Type\AdultOrientedEnumerationModel'];
    public const TYPES = ['Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
