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

final class TelephoneModel
{
    public const DESCRIPTION = 'The telephone number.';
    public const LABEL = 'telephone';
    public const NAME = 'schema:telephone';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'SchemaOrg\Type\ContactPointModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Place' => 'SchemaOrg\Type\PlaceModel'];
}
