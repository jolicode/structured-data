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

final class AvailableChannelModel
{
    public const DESCRIPTION = 'A means of accessing the service (e.g. a phone bank, a web site, a location, etc.).';
    public const LABEL = 'availableChannel';
    public const NAME = 'schema:availableChannel';
    public const VALUES = ['ServiceChannelModel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel'];
    public const TYPES = ['Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
}
