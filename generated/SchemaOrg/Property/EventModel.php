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

final class EventModel
{
    public const DESCRIPTION = 'Upcoming or past event associated with this place, organization, or action.';
    public const LABEL = 'event';
    public const NAME = 'schema:event';
    public const VALUES = ['EventModel' => 'SchemaOrg\Type\EventModel'];
    public const TYPES = ['InformAction' => 'SchemaOrg\Type\InformActionModel', 'InviteAction' => 'SchemaOrg\Type\InviteActionModel', 'JoinAction' => 'SchemaOrg\Type\JoinActionModel', 'LeaveAction' => 'SchemaOrg\Type\LeaveActionModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Place' => 'SchemaOrg\Type\PlaceModel', 'PlayAction' => 'SchemaOrg\Type\PlayActionModel'];
}
