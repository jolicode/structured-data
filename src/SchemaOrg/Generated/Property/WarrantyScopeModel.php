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

final class WarrantyScopeModel
{
    public const DESCRIPTION = 'The scope of the warranty promise.';
    public const LABEL = 'warrantyScope';
    public const NAME = 'schema:warrantyScope';
    public const VALUES = ['WarrantyScopeModel' => 'Jolicode\SchemaOrg\Type\WarrantyScopeModel'];
    public const TYPES = ['WarrantyPromise' => 'Jolicode\SchemaOrg\Type\WarrantyPromiseModel'];
}
