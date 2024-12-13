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

final class FunctionalClassModel
{
    public const DESCRIPTION = 'The degree of mobility the joint allows.';
    public const LABEL = 'functionalClass';
    public const NAME = 'schema:functionalClass';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Joint' => 'Jolicode\SchemaOrg\Type\JointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
