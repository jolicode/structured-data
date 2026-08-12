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

final class RelevantSpecialtyModel
{
    public const DESCRIPTION = 'If applicable, a medical specialty in which this entity is relevant.';
    public const LABEL = 'relevantSpecialty';
    public const NAME = 'schema:relevantSpecialty';
    public const VALUES = ['MedicalSpecialtyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalSpecialtyModel'];
    public const TYPES = ['MedicalEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
