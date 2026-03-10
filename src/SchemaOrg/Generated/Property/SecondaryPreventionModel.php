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

final class SecondaryPreventionModel
{
    public const DESCRIPTION = 'A preventative therapy used to prevent reoccurrence of the medical condition after an initial episode of the condition.';
    public const LABEL = 'secondaryPrevention';
    public const NAME = 'schema:secondaryPrevention';
    public const VALUES = ['DrugClassModel' => 'Jolicode\SchemaOrg\Type\DrugClassModel', 'DrugModel' => 'Jolicode\SchemaOrg\Type\DrugModel', 'LifestyleModificationModel' => 'Jolicode\SchemaOrg\Type\LifestyleModificationModel', 'MedicalTherapyModel' => 'Jolicode\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
