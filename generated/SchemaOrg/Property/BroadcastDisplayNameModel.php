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

final class BroadcastDisplayNameModel
{
    public const DESCRIPTION = 'The name displayed in the channel guide. For many US affiliates, it is the network name.';
    public const LABEL = 'broadcastDisplayName';
    public const NAME = 'schema:broadcastDisplayName';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\\Type\\BroadcastServiceModel'];
}
