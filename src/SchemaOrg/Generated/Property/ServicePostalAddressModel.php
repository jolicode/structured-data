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

final class ServicePostalAddressModel
{
    public const DESCRIPTION = 'The address for accessing the service by mail.';
    public const LABEL = 'servicePostalAddress';
    public const NAME = 'schema:servicePostalAddress';
    public const VALUES = ['PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel'];
    public const TYPES = ['ServiceChannel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
