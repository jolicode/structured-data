<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class NerveMotorModel
{
    public const DESCRIPTION = 'The neurological pathway extension that involves muscle control.';
    public const LABEL = 'nerveMotor';
    public const NAME = 'schema:nerveMotor';
    public const VALUES = ['MuscleModel' => 'SchemaOrg\\Type\\MuscleModel'];
    public const TYPES = ['Nerve' => 'SchemaOrg\\Type\\NerveModel'];
}
