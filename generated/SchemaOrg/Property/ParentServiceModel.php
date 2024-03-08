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

final class ParentServiceModel
{
    public const DESCRIPTION = 'A broadcast service to which the broadcast service may belong to such as regional variations of a national channel.';
    public const LABEL = 'parentService';
    public const NAME = 'schema:parentService';
    public const VALUES = ['BroadcastServiceModel' => 'SchemaOrg\\Type\\BroadcastServiceModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\\Type\\BroadcastServiceModel'];
}
