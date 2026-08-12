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

final class ContraindicationModel
{
    public const DESCRIPTION = 'A contraindication for this therapy.';
    public const LABEL = 'contraindication';
    public const NAME = 'schema:contraindication';
    public const VALUES = ['MedicalContraindicationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalContraindicationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalDeviceModel', 'MedicalTherapy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
