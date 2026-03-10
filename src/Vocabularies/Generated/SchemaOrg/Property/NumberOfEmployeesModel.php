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

final class NumberOfEmployeesModel
{
    public const DESCRIPTION = 'The number of employees in an organization, e.g. business.';
    public const LABEL = 'numberOfEmployees';
    public const NAME = 'schema:numberOfEmployees';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['BusinessAudience' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusinessAudienceModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
