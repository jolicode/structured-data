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

final class PrepTimeModel
{
    public const DESCRIPTION = 'The length of time it takes to prepare the items to be used in instructions or a direction, in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'prepTime';
    public const NAME = 'schema:prepTime';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['HowToDirection' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HowToModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
