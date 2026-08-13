<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PerformTimeModel
{
    public const DESCRIPTION = 'The length of time it takes to perform instructions or a direction (not including time to prepare the supplies), in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'performTime';
    public const NAME = 'schema:performTime';
    public const VALUES = ['DurationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['HowToDirection' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HowToModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
