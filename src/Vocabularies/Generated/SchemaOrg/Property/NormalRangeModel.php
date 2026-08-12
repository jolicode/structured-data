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

final class NormalRangeModel
{
    public const DESCRIPTION = 'Range of acceptable values for a typical patient, when applicable.';
    public const LABEL = 'normalRange';
    public const NAME = 'schema:normalRange';
    public const VALUES = ['MedicalEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEnumerationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalTest' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalTestModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
