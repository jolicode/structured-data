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

final class AggregateElementModel
{
    public const DESCRIPTION = 'Indicates a prototype of the elements in the list that is used to hold aggregate information (ratings, offers, etc.).';
    public const LABEL = 'aggregateElement';
    public const NAME = 'schema:aggregateElement';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['ItemList' => 'Jolicode\SchemaOrg\Type\ItemListModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
