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

final class ContactPointModel
{
    public const DESCRIPTION = 'A contact point for a person or organization.';
    public const LABEL = 'contactPoint';
    public const NAME = 'schema:contactPoint';
    public const VALUES = ['ContactPointModel' => 'SchemaOrg\\Type\\ContactPointModel'];
    public const TYPES = ['HealthInsurancePlan' => 'SchemaOrg\\Type\\HealthInsurancePlanModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Person' => 'SchemaOrg\\Type\\PersonModel'];
}
