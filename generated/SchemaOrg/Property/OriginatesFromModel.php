<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class OriginatesFromModel
{
    public const DESCRIPTION = 'The vasculature the lymphatic structure originates, or afferents, from.';
    public const LABEL = 'originatesFrom';
    public const NAME = 'schema:originatesFrom';
    public const VALUES = ['VesselModel' => 'SchemaOrg\\Type\\VesselModel'];
    public const TYPES = ['LymphaticVessel' => 'SchemaOrg\\Type\\LymphaticVesselModel'];
}
