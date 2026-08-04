<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ByMonthDayModel
{
    public const DESCRIPTION = 'Defines the day(s) of the month on which a recurring [[Event]] takes place. Specified as an [[Integer]] between 1-31.';
    public const LABEL = 'byMonthDay';
    public const NAME = 'schema:byMonthDay';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Schedule' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1457'];
    public const SUPERSEDED_BY = null;
}
