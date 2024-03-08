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

final class BroadcastChannelIdModel
{
    public const DESCRIPTION = 'The unique address by which the BroadcastService can be identified in a provider lineup. In US, this is typically a number.';
    public const LABEL = 'broadcastChannelId';
    public const NAME = 'schema:broadcastChannelId';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastChannel' => 'SchemaOrg\Type\BroadcastChannelModel'];
}
