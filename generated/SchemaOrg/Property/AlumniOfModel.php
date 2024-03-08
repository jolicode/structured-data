<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AlumniOfModel
{
    public const DESCRIPTION = 'An organization that the person is an alumni of.';
    public const LABEL = 'alumniOf';
    public const NAME = 'schema:alumniOf';
    public const VALUES = ['EducationalOrganizationModel' => 'SchemaOrg\\Type\\EducationalOrganizationModel', 'OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
