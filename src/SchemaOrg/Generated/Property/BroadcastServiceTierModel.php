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

final class BroadcastServiceTierModel
{
    public const DESCRIPTION = 'The type of service required to have access to the channel (e.g. Standard or Premium).';
    public const LABEL = 'broadcastServiceTier';
    public const NAME = 'schema:broadcastServiceTier';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastChannel' => 'Jolicode\SchemaOrg\Type\BroadcastChannelModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
