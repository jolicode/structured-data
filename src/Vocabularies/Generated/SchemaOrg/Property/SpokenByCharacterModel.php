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

final class SpokenByCharacterModel
{
    public const DESCRIPTION = 'The (e.g. fictional) character, Person or Organization to whom the quotation is attributed within the containing CreativeWork.';
    public const LABEL = 'spokenByCharacter';
    public const NAME = 'schema:spokenByCharacter';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Quotation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuotationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
