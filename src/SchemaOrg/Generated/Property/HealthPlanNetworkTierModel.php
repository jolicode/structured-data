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

final class HealthPlanNetworkTierModel
{
    public const DESCRIPTION = 'The tier(s) for this network.';
    public const LABEL = 'healthPlanNetworkTier';
    public const NAME = 'schema:healthPlanNetworkTier';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthPlanNetwork' => 'Jolicode\SchemaOrg\Type\HealthPlanNetworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
