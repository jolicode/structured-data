<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class HasMenuModel
{
    public const DESCRIPTION = 'Either the actual menu as a structured representation, as text, or a URL of the menu.';
    public const LABEL = 'hasMenu';
    public const NAME = 'schema:hasMenu';
    public const VALUES = ['MenuModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MenuModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FoodEstablishmentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
