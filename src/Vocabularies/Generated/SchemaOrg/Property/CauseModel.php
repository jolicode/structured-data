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

final class CauseModel
{
    public const DESCRIPTION = 'The cause of a medical condition.';
    public const LABEL = 'cause';
    public const NAME = 'schema:cause';
    public const VALUES = ['MedicalCauseModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalCauseModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
