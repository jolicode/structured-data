<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ImagingTechniqueModel
{
    public const DESCRIPTION = 'Imaging technique used.';
    public const LABEL = 'imagingTechnique';
    public const NAME = 'schema:imagingTechnique';
    public const VALUES = ['MedicalImagingTechniqueModel' => 'SchemaOrg\Type\MedicalImagingTechniqueModel'];
    public const TYPES = ['ImagingTest' => 'SchemaOrg\Type\ImagingTestModel'];
}
