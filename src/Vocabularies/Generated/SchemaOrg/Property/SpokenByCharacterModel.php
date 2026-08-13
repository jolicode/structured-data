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

final class SpokenByCharacterModel
{
    public const DESCRIPTION = 'The (e.g. fictional) character, Person or Organization to whom the quotation is attributed within the containing CreativeWork.';
    public const LABEL = 'spokenByCharacter';
    public const NAME = 'schema:spokenByCharacter';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Quotation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuotationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/271'];
    public const SUPERSEDED_BY = null;
}
