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

final class ContactPointModel
{
    public const DESCRIPTION = 'A contact point for a person or organization.';
    public const LABEL = 'contactPoint';
    public const NAME = 'schema:contactPoint';
    public const VALUES = ['ContactPointModel' => 'Jolicode\SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\SchemaOrg\Type\HealthInsurancePlanModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
}
