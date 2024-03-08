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

final class Gtin13Model
{
    public const DESCRIPTION = 'The GTIN-13 code of the product, or the product to which the offer refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13. Former 12-digit UPC codes can be converted into a GTIN-13 code by simply adding a preceding zero. See [GS1 GTIN Summary](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.';
    public const LABEL = 'gtin13';
    public const NAME = 'schema:gtin13';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
