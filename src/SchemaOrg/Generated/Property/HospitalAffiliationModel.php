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

final class HospitalAffiliationModel
{
    public const DESCRIPTION = 'A hospital with which the physician or office is affiliated.';
    public const LABEL = 'hospitalAffiliation';
    public const NAME = 'schema:hospitalAffiliation';
    public const VALUES = ['HospitalModel' => 'Jolicode\SchemaOrg\Type\HospitalModel'];
    public const TYPES = ['Physician' => 'Jolicode\SchemaOrg\Type\PhysicianModel'];
}
