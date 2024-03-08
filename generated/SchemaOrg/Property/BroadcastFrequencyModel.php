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

final class BroadcastFrequencyModel
{
    public const DESCRIPTION = 'The frequency used for over-the-air broadcasts. Numeric values or simple ranges, e.g. 87-99. In addition a shortcut idiom is supported for frequences of AM and FM radio channels, e.g. "87 FM".';
    public const LABEL = 'broadcastFrequency';
    public const NAME = 'schema:broadcastFrequency';
    public const VALUES = ['BroadcastFrequencySpecificationModel' => 'SchemaOrg\Type\BroadcastFrequencySpecificationModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastChannel' => 'SchemaOrg\Type\BroadcastChannelModel', 'BroadcastService' => 'SchemaOrg\Type\BroadcastServiceModel'];
}
