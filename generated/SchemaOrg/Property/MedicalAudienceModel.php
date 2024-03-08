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

final class MedicalAudienceModel
{
    public const DESCRIPTION = 'Medical audience for page.';
    public const LABEL = 'medicalAudience';
    public const NAME = 'schema:medicalAudience';
    public const VALUES = ['MedicalAudienceModel' => 'SchemaOrg\Type\MedicalAudienceModel', 'MedicalAudienceTypeModel' => 'SchemaOrg\Type\MedicalAudienceTypeModel'];
    public const TYPES = ['MedicalWebPage' => 'SchemaOrg\Type\MedicalWebPageModel'];
}
