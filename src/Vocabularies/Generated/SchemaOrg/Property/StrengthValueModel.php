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

final class StrengthValueModel
{
    public const DESCRIPTION = 'The value of an active ingredient\'s strength, e.g. 325.';
    public const LABEL = 'strengthValue';
    public const NAME = 'schema:strengthValue';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DrugStrength' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DrugStrengthModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
