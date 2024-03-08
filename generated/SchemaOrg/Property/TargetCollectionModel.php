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

final class TargetCollectionModel
{
    public const DESCRIPTION = 'A sub property of object. The collection target of the action.';
    public const LABEL = 'targetCollection';
    public const NAME = 'schema:targetCollection';
    public const VALUES = ['ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['UpdateAction' => 'SchemaOrg\Type\UpdateActionModel'];
}
