<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class KeywordsModel
{
    public const DESCRIPTION = 'Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.';
    public const LABEL = 'keywords';
    public const NAME = 'schema:keywords';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Event' => 'SchemaOrg\\Type\\EventModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
