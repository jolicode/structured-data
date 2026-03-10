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

final class MaximumIntakeModel
{
    public const DESCRIPTION = 'Recommended intake of this supplement for a given population as defined by a specific recommending authority.';
    public const LABEL = 'maximumIntake';
    public const NAME = 'schema:maximumIntake';
    public const VALUES = ['MaximumDoseScheduleModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MaximumDoseScheduleModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\Vocabularies\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'Jolicode\Vocabularies\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
