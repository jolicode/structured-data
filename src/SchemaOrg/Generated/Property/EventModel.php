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

final class EventModel
{
    public const DESCRIPTION = 'Upcoming or past event associated with this place, organization, or action.';
    public const LABEL = 'event';
    public const NAME = 'schema:event';
    public const VALUES = ['EventModel' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const TYPES = ['InformAction' => 'Jolicode\SchemaOrg\Type\InformActionModel', 'InviteAction' => 'Jolicode\SchemaOrg\Type\InviteActionModel', 'JoinAction' => 'Jolicode\SchemaOrg\Type\JoinActionModel', 'LeaveAction' => 'Jolicode\SchemaOrg\Type\LeaveActionModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'PlayAction' => 'Jolicode\SchemaOrg\Type\PlayActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
