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

final class WeightPercentageModel
{
    public const DESCRIPTION = 'Value in the range [0.0 ; 1.0] representing the fraction of the weight that is used to compute the shipping price.';
    public const LABEL = 'weightPercentage';
    public const NAME = 'schema:weightPercentage';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['ShippingRateSettings' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
