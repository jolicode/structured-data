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

final class FunctionalClassModel
{
    public const DESCRIPTION = 'The degree of mobility the joint allows.';
    public const LABEL = 'functionalClass';
    public const NAME = 'schema:functionalClass';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Joint' => 'Jolicode\Vocabularies\SchemaOrg\Type\JointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
