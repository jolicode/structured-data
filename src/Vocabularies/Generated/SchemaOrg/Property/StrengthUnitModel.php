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

final class StrengthUnitModel
{
    public const DESCRIPTION = 'The units of an active ingredient\'s strength, e.g. mg.';
    public const LABEL = 'strengthUnit';
    public const NAME = 'schema:strengthUnit';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugStrength' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugStrengthModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
