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

final class IsResizableModel
{
    public const DESCRIPTION = 'Whether the 3DModel allows resizing. For example, room layout applications often do not allow 3DModel elements to be resized to reflect reality.';
    public const LABEL = 'isResizable';
    public const NAME = 'schema:isResizable';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['3DModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\3DModelModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2394'];
    public const SUPERSEDED_BY = null;
}
