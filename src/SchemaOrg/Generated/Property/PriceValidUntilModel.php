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

final class PriceValidUntilModel
{
    public const DESCRIPTION = 'The date after which the price is no longer available.';
    public const LABEL = 'priceValidUntil';
    public const NAME = 'schema:priceValidUntil';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
}
