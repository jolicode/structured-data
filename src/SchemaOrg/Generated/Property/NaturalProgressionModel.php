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

final class NaturalProgressionModel
{
    public const DESCRIPTION = 'The expected progression of the condition if it is not treated and allowed to progress naturally.';
    public const LABEL = 'naturalProgression';
    public const NAME = 'schema:naturalProgression';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel'];
}
