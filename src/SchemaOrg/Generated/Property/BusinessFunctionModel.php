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

final class BusinessFunctionModel
{
    public const DESCRIPTION = 'The business function (e.g. sell, lease, repair, dispose) of the offer or component of a bundle (TypeAndQuantityNode). The default is http://purl.org/goodrelations/v1#Sell.';
    public const LABEL = 'businessFunction';
    public const NAME = 'schema:businessFunction';
    public const VALUES = ['BusinessFunctionModel' => 'Jolicode\SchemaOrg\Type\BusinessFunctionModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'TypeAndQuantityNode' => 'Jolicode\SchemaOrg\Type\TypeAndQuantityNodeModel'];
}
