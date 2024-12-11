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

final class SignDetectedModel
{
    public const DESCRIPTION = 'A sign detected by the test.';
    public const LABEL = 'signDetected';
    public const NAME = 'schema:signDetected';
    public const VALUES = ['MedicalSignModel' => 'Jolicode\SchemaOrg\Type\MedicalSignModel'];
    public const TYPES = ['MedicalTest' => 'Jolicode\SchemaOrg\Type\MedicalTestModel'];
}
