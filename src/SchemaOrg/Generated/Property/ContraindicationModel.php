<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ContraindicationModel
{
    public const DESCRIPTION = 'A contraindication for this therapy.';
    public const LABEL = 'contraindication';
    public const NAME = 'schema:contraindication';
    public const VALUES = ['MedicalContraindicationModel' => 'Jolicode\SchemaOrg\Type\MedicalContraindicationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel', 'MedicalTherapy' => 'Jolicode\SchemaOrg\Type\MedicalTherapyModel'];
}
