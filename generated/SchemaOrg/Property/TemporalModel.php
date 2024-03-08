<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TemporalModel
{
    public const DESCRIPTION = 'The "temporal" property can be used in cases where more specific properties
(e.g. [[temporalCoverage]], [[dateCreated]], [[dateModified]], [[datePublished]]) are not known to be appropriate.';
    public const LABEL = 'temporal';
    public const NAME = 'schema:temporal';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
