<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class Gtin14Model
{
    public const DESCRIPTION = 'The GTIN-14 code of the product, or the product to which the offer refers. See [GS1 GTIN Summary](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.';
    public const LABEL = 'gtin14';
    public const NAME = 'schema:gtin14';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
