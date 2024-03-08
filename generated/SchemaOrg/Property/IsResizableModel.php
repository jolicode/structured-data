<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IsResizableModel
{
    public const DESCRIPTION = 'Whether the 3DModel allows resizing. For example, room layout applications often do not allow 3DModel elements to be resized to reflect reality.';
    public const LABEL = 'isResizable';
    public const NAME = 'schema:isResizable';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['3DModel' => 'SchemaOrg\\Type\\3DModelModel'];
}
