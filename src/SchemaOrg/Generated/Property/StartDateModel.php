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

final class StartDateModel
{
    public const DESCRIPTION = 'The start date and time of the item (in [ISO 8601 date format](http://en.wikipedia.org/wiki/ISO_8601)).';
    public const LABEL = 'startDate';
    public const NAME = 'schema:startDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel', 'CreativeWorkSeries' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeriesModel', 'DatedMoneySpecification' => 'Jolicode\SchemaOrg\Type\DatedMoneySpecificationModel', 'EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel', 'Role' => 'Jolicode\SchemaOrg\Type\RoleModel', 'Schedule' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
