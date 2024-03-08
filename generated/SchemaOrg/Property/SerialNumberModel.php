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

final class SerialNumberModel
{
    public const DESCRIPTION = 'The serial number or any alphanumeric identifier of a particular product. When attached to an offer, it is a shortcut for the serial number of the product included in the offer.';
    public const LABEL = 'serialNumber';
    public const NAME = 'schema:serialNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\Type\DemandModel', 'IndividualProduct' => 'SchemaOrg\Type\IndividualProductModel', 'Offer' => 'SchemaOrg\Type\OfferModel'];
}
