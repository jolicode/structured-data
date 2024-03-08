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

final class DoseValueModel
{
    public const DESCRIPTION = 'The value of the dose, e.g. 500.';
    public const LABEL = 'doseValue';
    public const NAME = 'schema:doseValue';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'QualitativeValueModel' => 'SchemaOrg\Type\QualitativeValueModel'];
    public const TYPES = ['DoseSchedule' => 'SchemaOrg\Type\DoseScheduleModel'];
}
