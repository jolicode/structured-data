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

final class ClipNumberModel
{
    public const DESCRIPTION = 'Position of the clip within an ordered group of clips.';
    public const LABEL = 'clipNumber';
    public const NAME = 'schema:clipNumber';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Clip' => 'Jolicode\SchemaOrg\Type\ClipModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
