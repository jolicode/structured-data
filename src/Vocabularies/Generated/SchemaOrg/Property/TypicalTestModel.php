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

final class TypicalTestModel
{
    public const DESCRIPTION = 'A medical test typically performed given this condition.';
    public const LABEL = 'typicalTest';
    public const NAME = 'schema:typicalTest';
    public const VALUES = ['MedicalTestModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalTestModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
