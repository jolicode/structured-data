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

final class HasBroadcastChannelModel
{
    public const DESCRIPTION = 'A broadcast channel of a broadcast service.';
    public const LABEL = 'hasBroadcastChannel';
    public const NAME = 'schema:hasBroadcastChannel';
    public const VALUES = ['BroadcastChannelModel' => 'SchemaOrg\\Type\\BroadcastChannelModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\\Type\\BroadcastServiceModel'];
}
