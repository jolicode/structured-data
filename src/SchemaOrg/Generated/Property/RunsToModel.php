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

final class RunsToModel
{
    public const DESCRIPTION = 'The vasculature the lymphatic structure runs, or efferents, to.';
    public const LABEL = 'runsTo';
    public const NAME = 'schema:runsTo';
    public const VALUES = ['VesselModel' => 'Jolicode\SchemaOrg\Type\VesselModel'];
    public const TYPES = ['LymphaticVessel' => 'Jolicode\SchemaOrg\Type\LymphaticVesselModel'];
}
