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

final class LandlordModel
{
    public const DESCRIPTION = 'A sub property of participant. The owner of the real estate property.';
    public const LABEL = 'landlord';
    public const NAME = 'schema:landlord';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['RentAction' => 'Jolicode\SchemaOrg\Type\RentActionModel'];
}
