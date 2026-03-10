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

final class ContactPointModel
{
    public const DESCRIPTION = 'A contact point for a person or organization.';
    public const LABEL = 'contactPoint';
    public const NAME = 'schema:contactPoint';
    public const VALUES = ['ContactPointModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['HealthInsurancePlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\HealthInsurancePlanModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
