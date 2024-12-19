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

final class BroadcastAffiliateOfModel
{
    public const DESCRIPTION = 'The media network(s) whose content is broadcast on this station.';
    public const LABEL = 'broadcastAffiliateOf';
    public const NAME = 'schema:broadcastAffiliateOf';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['BroadcastService' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
