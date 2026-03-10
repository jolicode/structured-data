<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class AvailableDeliveryMethodModel
{
    public const DESCRIPTION = 'The delivery method(s) available for this offer.';
    public const LABEL = 'availableDeliveryMethod';
    public const NAME = 'schema:availableDeliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
