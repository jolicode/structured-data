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

final class BroadcastFrequencyModel
{
    public const DESCRIPTION = 'The frequency used for over-the-air broadcasts. Numeric values or simple ranges, e.g. 87-99. In addition a shortcut idiom is supported for frequencies of AM and FM radio channels, e.g. "87 FM".';
    public const LABEL = 'broadcastFrequency';
    public const NAME = 'schema:broadcastFrequency';
    public const VALUES = ['BroadcastFrequencySpecificationModel' => 'Jolicode\SchemaOrg\Type\BroadcastFrequencySpecificationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastChannel' => 'Jolicode\SchemaOrg\Type\BroadcastChannelModel', 'BroadcastService' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
