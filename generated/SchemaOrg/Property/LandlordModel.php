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

final class LandlordModel
{
    public const DESCRIPTION = 'A sub property of participant. The owner of the real estate property.';
    public const LABEL = 'landlord';
    public const NAME = 'schema:landlord';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['RentAction' => 'SchemaOrg\\Type\\RentActionModel'];
}
