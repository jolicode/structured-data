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

final class ServiceUrlModel
{
    public const DESCRIPTION = 'The website to access the service.';
    public const LABEL = 'serviceUrl';
    public const NAME = 'schema:serviceUrl';
    public const VALUES = ['URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ServiceChannel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel'];
}
