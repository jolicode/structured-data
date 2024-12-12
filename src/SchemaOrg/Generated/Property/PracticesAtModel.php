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

final class PracticesAtModel
{
    public const DESCRIPTION = 'A [[MedicalOrganization]] where the [[IndividualPhysician]] practices.';
    public const LABEL = 'practicesAt';
    public const NAME = 'schema:practicesAt';
    public const VALUES = ['MedicalOrganizationModel' => 'Jolicode\SchemaOrg\Type\MedicalOrganizationModel'];
    public const TYPES = ['IndividualPhysician' => 'Jolicode\SchemaOrg\Type\IndividualPhysicianModel'];
}
