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

final class VendorModel
{
    public const DESCRIPTION = '\'vendor\' is an earlier term for \'seller\'.';
    public const LABEL = 'vendor';
    public const NAME = 'schema:vendor';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['BuyAction' => 'SchemaOrg\\Type\\BuyActionModel'];
}
