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

final class SerialNumberModel
{
    public const DESCRIPTION = 'The serial number or any alphanumeric identifier of a particular product. When attached to an offer, it is a shortcut for the serial number of the product included in the offer.';
    public const LABEL = 'serialNumber';
    public const NAME = 'schema:serialNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'IndividualProduct' => 'Jolicode\SchemaOrg\Type\IndividualProductModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
