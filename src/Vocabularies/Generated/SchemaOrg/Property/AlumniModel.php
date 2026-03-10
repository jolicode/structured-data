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

final class AlumniModel
{
    public const DESCRIPTION = 'Alumni of an organization.';
    public const LABEL = 'alumni';
    public const NAME = 'schema:alumni';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['EducationalOrganization' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOrganizationModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
