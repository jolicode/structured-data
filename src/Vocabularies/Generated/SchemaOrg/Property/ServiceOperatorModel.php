<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ServiceOperatorModel
{
    public const DESCRIPTION = 'The operating organization, if different from the provider.  This enables the representation of services that are provided by an organization, but operated by another organization like a subcontractor.';
    public const LABEL = 'serviceOperator';
    public const NAME = 'schema:serviceOperator';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['GovernmentService' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GovernmentServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
