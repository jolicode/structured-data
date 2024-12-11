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

final class RecordLabelModel
{
    public const DESCRIPTION = 'The label that issued the release.';
    public const LABEL = 'recordLabel';
    public const NAME = 'schema:recordLabel';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['MusicRelease' => 'Jolicode\SchemaOrg\Type\MusicReleaseModel'];
}
