<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ContraindicationModel
{
    public const DESCRIPTION = 'A contraindication for this therapy.';
    public const LABEL = 'contraindication';
    public const NAME = 'schema:contraindication';
    public const VALUES = ['MedicalContraindicationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalContraindicationModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalDeviceModel', 'MedicalTherapy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalTherapyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
