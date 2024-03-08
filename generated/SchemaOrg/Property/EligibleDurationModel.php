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

final class EligibleDurationModel
{
    public const DESCRIPTION = 'The duration for which the given offer is valid.';
    public const LABEL = 'eligibleDuration';
    public const NAME = 'schema:eligibleDuration';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\Type\DemandModel', 'Offer' => 'SchemaOrg\Type\OfferModel'];
}
