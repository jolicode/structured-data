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

final class AcceptedOfferModel
{
    public const DESCRIPTION = 'The offer(s) -- e.g., product, quantity and price combinations -- included in the order.';
    public const LABEL = 'acceptedOffer';
    public const NAME = 'schema:acceptedOffer';
    public const VALUES = ['OfferModel' => 'Jolicode\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
}
