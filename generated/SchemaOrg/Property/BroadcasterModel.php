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

final class BroadcasterModel
{
    public const DESCRIPTION = 'The organization owning or operating the broadcast service.';
    public const LABEL = 'broadcaster';
    public const NAME = 'schema:broadcaster';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\Type\BroadcastServiceModel'];
}
