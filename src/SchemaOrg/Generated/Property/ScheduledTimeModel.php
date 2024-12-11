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

final class ScheduledTimeModel
{
    public const DESCRIPTION = 'The time the object is scheduled to.';
    public const LABEL = 'scheduledTime';
    public const NAME = 'schema:scheduledTime';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['PlanAction' => 'Jolicode\SchemaOrg\Type\PlanActionModel'];
}
