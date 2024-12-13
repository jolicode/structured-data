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

final class BroadcastSubChannelModel
{
    public const DESCRIPTION = 'The subchannel used for the broadcast.';
    public const LABEL = 'broadcastSubChannel';
    public const NAME = 'schema:broadcastSubChannel';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'Jolicode\SchemaOrg\Type\BroadcastFrequencySpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
