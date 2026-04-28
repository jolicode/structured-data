<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class TemporalModel
{
    public const DESCRIPTION = 'The "temporal" property can be used in cases where more specific properties
(e.g. [[temporalCoverage]], [[dateCreated]], [[dateModified]], [[datePublished]]) are not known to be appropriate.';
    public const LABEL = 'temporal';
    public const NAME = 'schema:temporal';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
