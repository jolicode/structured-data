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

final class KeywordsModel
{
    public const DESCRIPTION = 'Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.';
    public const LABEL = 'keywords';
    public const NAME = 'schema:keywords';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
