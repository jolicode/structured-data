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

final class DoseValueModel
{
    public const DESCRIPTION = 'The value of the dose, e.g. 500.';
    public const LABEL = 'doseValue';
    public const NAME = 'schema:doseValue';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel'];
    public const TYPES = ['DoseSchedule' => 'Jolicode\Vocabularies\SchemaOrg\Type\DoseScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
