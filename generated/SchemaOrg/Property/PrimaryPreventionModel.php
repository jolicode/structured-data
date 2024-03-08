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

final class PrimaryPreventionModel
{
    public const DESCRIPTION = 'A preventative therapy used to prevent an initial occurrence of the medical condition, such as vaccination.';
    public const LABEL = 'primaryPrevention';
    public const NAME = 'schema:primaryPrevention';
    public const VALUES = ['MedicalTherapyModel' => 'SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'SchemaOrg\Type\MedicalConditionModel'];
}
