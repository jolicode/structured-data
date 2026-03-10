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

final class TargetNameModel
{
    public const DESCRIPTION = 'The name of a node in an established educational framework.';
    public const LABEL = 'targetName';
    public const NAME = 'schema:targetName';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AlignmentObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\AlignmentObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
