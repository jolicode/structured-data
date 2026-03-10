<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class EventModel
{
    public const DESCRIPTION = 'Upcoming or past event associated with this place, organization, or action.';
    public const LABEL = 'event';
    public const NAME = 'schema:event';
    public const VALUES = ['EventModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const TYPES = ['InformAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\InformActionModel', 'InviteAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\InviteActionModel', 'JoinAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\JoinActionModel', 'LeaveAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\LeaveActionModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'PlayAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlayActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
