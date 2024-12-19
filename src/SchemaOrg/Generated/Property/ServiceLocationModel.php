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

final class ServiceLocationModel
{
    public const DESCRIPTION = 'The location (e.g. civic structure, local business, etc.) where a person can go to access the service.';
    public const LABEL = 'serviceLocation';
    public const NAME = 'schema:serviceLocation';
    public const VALUES = ['PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ServiceChannel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
