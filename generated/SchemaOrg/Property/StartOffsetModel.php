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

final class StartOffsetModel
{
    public const DESCRIPTION = 'The start time of the clip expressed as the number of seconds from the beginning of the work.';
    public const LABEL = 'startOffset';
    public const NAME = 'schema:startOffset';
    public const VALUES = ['HyperTocEntryModel' => 'SchemaOrg\Type\HyperTocEntryModel', 'NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\Type\ClipModel', 'SeekToAction' => 'SchemaOrg\Type\SeekToActionModel'];
}
