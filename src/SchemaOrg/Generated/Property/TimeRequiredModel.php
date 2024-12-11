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

final class TimeRequiredModel
{
    public const DESCRIPTION = 'Approximate or typical time it usually takes to work with or through the content of this work for the typical or target audience.';
    public const LABEL = 'timeRequired';
    public const NAME = 'schema:timeRequired';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
}
