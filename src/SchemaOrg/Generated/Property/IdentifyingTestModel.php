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

final class IdentifyingTestModel
{
    public const DESCRIPTION = 'A diagnostic test that can identify this sign.';
    public const LABEL = 'identifyingTest';
    public const NAME = 'schema:identifyingTest';
    public const VALUES = ['MedicalTestModel' => 'Jolicode\SchemaOrg\Type\MedicalTestModel'];
    public const TYPES = ['MedicalSign' => 'Jolicode\SchemaOrg\Type\MedicalSignModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
