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

final class SeasonalOverrideModel
{
    public const DESCRIPTION = 'Limited period during which these shipping conditions apply.';
    public const LABEL = 'seasonalOverride';
    public const NAME = 'schema:seasonalOverride';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['ShippingConditions' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
