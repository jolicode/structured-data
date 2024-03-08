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

final class PerformersModel
{
    public const DESCRIPTION = 'The main performer or performers of the event&#x2014;for example, a presenter, musician, or actor.';
    public const LABEL = 'performers';
    public const NAME = 'schema:performers';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel'];
}
