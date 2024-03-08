<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TargetDescriptionModel
{
    public const DESCRIPTION = 'The description of a node in an established educational framework.';
    public const LABEL = 'targetDescription';
    public const NAME = 'schema:targetDescription';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['AlignmentObject' => 'SchemaOrg\Type\AlignmentObjectModel'];
}
