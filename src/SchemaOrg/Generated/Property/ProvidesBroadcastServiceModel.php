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

final class ProvidesBroadcastServiceModel
{
    public const DESCRIPTION = 'The BroadcastService offered on this channel.';
    public const LABEL = 'providesBroadcastService';
    public const NAME = 'schema:providesBroadcastService';
    public const VALUES = ['BroadcastServiceModel' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel'];
    public const TYPES = ['BroadcastChannel' => 'Jolicode\SchemaOrg\Type\BroadcastChannelModel'];
}
