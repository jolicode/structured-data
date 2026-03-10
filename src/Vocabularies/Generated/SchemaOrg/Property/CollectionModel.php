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

final class CollectionModel
{
    public const DESCRIPTION = 'A sub property of object. The collection target of the action.';
    public const LABEL = 'collection';
    public const NAME = 'schema:collection';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['UpdateAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\UpdateActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
