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

final class ToolModel
{
    public const DESCRIPTION = 'A sub property of instrument. An object used (but not consumed) when performing instructions or a direction.';
    public const LABEL = 'tool';
    public const NAME = 'schema:tool';
    public const VALUES = ['HowToToolModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToToolModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowToDirection' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
