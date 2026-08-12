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

final class AvailableStrengthModel
{
    public const DESCRIPTION = 'An available dosage strength for the drug.';
    public const LABEL = 'availableStrength';
    public const NAME = 'schema:availableStrength';
    public const VALUES = ['DrugStrengthModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugStrengthModel'];
    public const TYPES = ['Drug' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
