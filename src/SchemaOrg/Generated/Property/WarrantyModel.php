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

final class WarrantyModel
{
    public const DESCRIPTION = 'The warranty promise(s) included in the offer.';
    public const LABEL = 'warranty';
    public const NAME = 'schema:warranty';
    public const VALUES = ['WarrantyPromiseModel' => 'Jolicode\SchemaOrg\Type\WarrantyPromiseModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
}
