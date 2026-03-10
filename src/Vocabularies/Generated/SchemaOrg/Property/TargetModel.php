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

final class TargetModel
{
    public const DESCRIPTION = 'Indicates a target EntryPoint, or url, for an Action.';
    public const LABEL = 'target';
    public const NAME = 'schema:target';
    public const VALUES = ['EntryPointModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EntryPointModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
