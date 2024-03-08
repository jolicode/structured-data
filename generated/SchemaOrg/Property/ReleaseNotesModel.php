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

final class ReleaseNotesModel
{
    public const DESCRIPTION = 'Description of what changed in this version.';
    public const LABEL = 'releaseNotes';
    public const NAME = 'schema:releaseNotes';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
}
