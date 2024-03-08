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

final class InBroadcastLineupModel
{
    public const DESCRIPTION = 'The CableOrSatelliteService offering the channel.';
    public const LABEL = 'inBroadcastLineup';
    public const NAME = 'schema:inBroadcastLineup';
    public const VALUES = ['CableOrSatelliteServiceModel' => 'SchemaOrg\\Type\\CableOrSatelliteServiceModel'];
    public const TYPES = ['BroadcastChannel' => 'SchemaOrg\\Type\\BroadcastChannelModel'];
}
