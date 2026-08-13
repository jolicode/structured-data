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

final class PreparationModel
{
    public const DESCRIPTION = 'Typical preparation that a patient must undergo before having the procedure performed.';
    public const LABEL = 'preparation';
    public const NAME = 'schema:preparation';
    public const VALUES = ['MedicalEntityModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalProcedure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalProcedureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
