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

final class StartDateModel
{
    public const DESCRIPTION = 'The start date and time of the item (in [ISO 8601 date format](http://en.wikipedia.org/wiki/ISO_8601)).';
    public const LABEL = 'startDate';
    public const NAME = 'schema:startDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\Type\CreativeWorkSeasonModel', 'CreativeWorkSeries' => 'SchemaOrg\Type\CreativeWorkSeriesModel', 'DatedMoneySpecification' => 'SchemaOrg\Type\DatedMoneySpecificationModel', 'EducationalOccupationalProgram' => 'SchemaOrg\Type\EducationalOccupationalProgramModel', 'Event' => 'SchemaOrg\Type\EventModel', 'MerchantReturnPolicySeasonalOverride' => 'SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel', 'Role' => 'SchemaOrg\Type\RoleModel', 'Schedule' => 'SchemaOrg\Type\ScheduleModel'];
}
