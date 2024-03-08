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

final class BloodSupplyModel
{
    public const DESCRIPTION = 'The blood vessel that carries blood from the heart to the muscle.';
    public const LABEL = 'bloodSupply';
    public const NAME = 'schema:bloodSupply';
    public const VALUES = ['VesselModel' => 'SchemaOrg\Type\VesselModel'];
    public const TYPES = ['Muscle' => 'SchemaOrg\Type\MuscleModel'];
}
