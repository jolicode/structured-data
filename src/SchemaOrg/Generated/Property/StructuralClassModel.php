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

final class StructuralClassModel
{
    public const DESCRIPTION = 'The name given to how bone physically connects to each other.';
    public const LABEL = 'structuralClass';
    public const NAME = 'schema:structuralClass';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Joint' => 'Jolicode\SchemaOrg\Type\JointModel'];
}
