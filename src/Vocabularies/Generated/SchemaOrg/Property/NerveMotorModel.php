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

final class NerveMotorModel
{
    public const DESCRIPTION = 'The neurological pathway extension that involves muscle control.';
    public const LABEL = 'nerveMotor';
    public const NAME = 'schema:nerveMotor';
    public const VALUES = ['MuscleModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MuscleModel'];
    public const TYPES = ['Nerve' => 'Jolicode\Vocabularies\SchemaOrg\Type\NerveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
