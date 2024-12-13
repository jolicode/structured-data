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

final class WorkLocationModel
{
    public const DESCRIPTION = 'A contact location for a person\'s place of work.';
    public const LABEL = 'workLocation';
    public const NAME = 'schema:workLocation';
    public const VALUES = ['ContactPointModel' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
