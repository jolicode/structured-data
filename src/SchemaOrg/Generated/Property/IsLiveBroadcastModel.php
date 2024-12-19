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

final class IsLiveBroadcastModel
{
    public const DESCRIPTION = 'True if the broadcast is of a live event.';
    public const LABEL = 'isLiveBroadcast';
    public const NAME = 'schema:isLiveBroadcast';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['BroadcastEvent' => 'Jolicode\SchemaOrg\Type\BroadcastEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
