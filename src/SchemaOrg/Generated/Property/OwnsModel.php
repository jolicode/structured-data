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

final class OwnsModel
{
    public const DESCRIPTION = 'Products owned by the organization or person.';
    public const LABEL = 'owns';
    public const NAME = 'schema:owns';
    public const VALUES = ['OwnershipInfoModel' => 'Jolicode\SchemaOrg\Type\OwnershipInfoModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
}
