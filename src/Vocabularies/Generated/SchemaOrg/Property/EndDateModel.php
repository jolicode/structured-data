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

final class EndDateModel
{
    public const DESCRIPTION = 'The end date and time of the item (in [ISO 8601 date format](http://en.wikipedia.org/wiki/ISO_8601)).';
    public const LABEL = 'endDate';
    public const NAME = 'schema:endDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkSeasonModel', 'CreativeWorkSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkSeriesModel', 'DatedMoneySpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\DatedMoneySpecificationModel', 'EducationalOccupationalProgram' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalProgramModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel', 'Role' => 'Jolicode\Vocabularies\SchemaOrg\Type\RoleModel', 'Schedule' => 'Jolicode\Vocabularies\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
