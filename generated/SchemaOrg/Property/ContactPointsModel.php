<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ContactPointsModel
{
    public const DESCRIPTION = 'A contact point for a person or organization.';
    public const LABEL = 'contactPoints';
    public const NAME = 'schema:contactPoints';
    public const VALUES = ['ContactPointModel' => 'SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
