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

final class MpnModel
{
    public const DESCRIPTION = 'The Manufacturer Part Number (MPN) of the product, or the product to which the offer refers.';
    public const LABEL = 'mpn';
    public const NAME = 'schema:mpn';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
