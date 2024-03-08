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

final class MaximumIntakeModel
{
    public const DESCRIPTION = 'Recommended intake of this supplement for a given population as defined by a specific recommending authority.';
    public const LABEL = 'maximumIntake';
    public const NAME = 'schema:maximumIntake';
    public const VALUES = ['MaximumDoseScheduleModel' => 'SchemaOrg\Type\MaximumDoseScheduleModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'SchemaOrg\Type\DrugModel', 'DrugStrength' => 'SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'SchemaOrg\Type\SubstanceModel'];
}
