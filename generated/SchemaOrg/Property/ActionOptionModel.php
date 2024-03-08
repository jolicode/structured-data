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

final class ActionOptionModel
{
    public const DESCRIPTION = 'A sub property of object. The options subject to this action.';
    public const LABEL = 'actionOption';
    public const NAME = 'schema:actionOption';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['ChooseAction' => 'SchemaOrg\Type\ChooseActionModel'];
}
