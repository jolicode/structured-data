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

final class AddOnModel
{
    public const DESCRIPTION = 'An additional offer that can only be obtained in combination with the first base offer (e.g. supplements and extensions that are available for a surcharge).';
    public const LABEL = 'addOn';
    public const NAME = 'schema:addOn';
    public const VALUES = ['OfferModel' => 'SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Offer' => 'SchemaOrg\Type\OfferModel'];
}
