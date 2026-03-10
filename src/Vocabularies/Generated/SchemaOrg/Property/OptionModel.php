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

final class OptionModel
{
    public const DESCRIPTION = 'A sub property of object. The options subject to this action.';
    public const LABEL = 'option';
    public const NAME = 'schema:option';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['ChooseAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ChooseActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
