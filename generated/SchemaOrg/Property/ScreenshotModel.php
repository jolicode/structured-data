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

final class ScreenshotModel
{
    public const DESCRIPTION = 'A link to a screenshot image of the app.';
    public const LABEL = 'screenshot';
    public const NAME = 'schema:screenshot';
    public const VALUES = ['ImageObjectModel' => 'SchemaOrg\\Type\\ImageObjectModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
}
