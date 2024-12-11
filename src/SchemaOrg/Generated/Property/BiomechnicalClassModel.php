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

final class BiomechnicalClassModel
{
    public const DESCRIPTION = 'The biomechanical properties of the bone.';
    public const LABEL = 'biomechnicalClass';
    public const NAME = 'schema:biomechnicalClass';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Joint' => 'Jolicode\SchemaOrg\Type\JointModel'];
}
