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

final class TargetNameModel
{
    public const DESCRIPTION = 'The name of a node in an established educational framework.';
    public const LABEL = 'targetName';
    public const NAME = 'schema:targetName';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AlignmentObject' => 'Jolicode\SchemaOrg\Type\AlignmentObjectModel'];
}
