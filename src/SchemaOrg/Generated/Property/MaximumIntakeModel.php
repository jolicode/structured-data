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

final class MaximumIntakeModel
{
    public const DESCRIPTION = 'Recommended intake of this supplement for a given population as defined by a specific recommending authority.';
    public const LABEL = 'maximumIntake';
    public const NAME = 'schema:maximumIntake';
    public const VALUES = ['MaximumDoseScheduleModel' => 'Jolicode\SchemaOrg\Type\MaximumDoseScheduleModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'Jolicode\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'Jolicode\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
