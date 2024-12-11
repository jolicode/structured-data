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

final class AcquiredFromModel
{
    public const DESCRIPTION = 'The organization or person from which the product was acquired.';
    public const LABEL = 'acquiredFrom';
    public const NAME = 'schema:acquiredFrom';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['OwnershipInfo' => 'Jolicode\SchemaOrg\Type\OwnershipInfoModel'];
}
