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

final class FaxNumberModel
{
    public const DESCRIPTION = 'The fax number.';
    public const LABEL = 'faxNumber';
    public const NAME = 'schema:faxNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
}
