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

final class TargetPopulationModel
{
    public const DESCRIPTION = 'Characteristics of the population for which this is intended, or which typically uses it, e.g. \'adults\'.';
    public const LABEL = 'targetPopulation';
    public const NAME = 'schema:targetPopulation';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'DoseSchedule' => 'SchemaOrg\Type\DoseScheduleModel'];
}
