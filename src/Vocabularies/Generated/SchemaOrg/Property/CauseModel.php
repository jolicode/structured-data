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

final class CauseModel
{
    public const DESCRIPTION = 'The cause of a medical condition.';
    public const LABEL = 'cause';
    public const NAME = 'schema:cause';
    public const VALUES = ['MedicalCauseModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalCauseModel'];
    public const TYPES = ['MedicalCondition' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
