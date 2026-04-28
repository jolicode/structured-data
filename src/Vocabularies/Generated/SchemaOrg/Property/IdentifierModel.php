<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class IdentifierModel
{
    public const DESCRIPTION = 'The identifier property represents any kind of identifier for any kind of [[Thing]], such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links. See [background notes](/docs/datamodel.html#identifierBg) for more details.';
    public const LABEL = 'identifier';
    public const NAME = 'schema:identifier';
    public const VALUES = ['PropertyValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Thing' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ThingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
