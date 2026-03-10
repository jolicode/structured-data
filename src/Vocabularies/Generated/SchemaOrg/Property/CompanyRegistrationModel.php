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

final class CompanyRegistrationModel
{
    public const DESCRIPTION = 'The official registration number of a business including the organization that issued it such as Company House or Chamber of Commerce.';
    public const LABEL = 'companyRegistration';
    public const NAME = 'schema:companyRegistration';
    public const VALUES = ['CertificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
