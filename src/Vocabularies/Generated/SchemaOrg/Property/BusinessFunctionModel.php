<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class BusinessFunctionModel
{
    public const DESCRIPTION = 'The business function (e.g. sell, lease, repair, dispose) of the offer or component of a bundle (TypeAndQuantityNode). The default is http://purl.org/goodrelations/v1#Sell.';
    public const LABEL = 'businessFunction';
    public const NAME = 'schema:businessFunction';
    public const VALUES = ['BusinessFunctionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BusinessFunctionModel'];
    public const TYPES = ['Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'TypeAndQuantityNode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TypeAndQuantityNodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
