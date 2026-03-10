<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class MusicReleaseFormatModel
{
    public const DESCRIPTION = 'Format of this release (the type of recording media used, i.e. compact disc, digital media, LP, etc.).';
    public const LABEL = 'musicReleaseFormat';
    public const NAME = 'schema:musicReleaseFormat';
    public const VALUES = ['MusicReleaseFormatTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicReleaseFormatTypeModel'];
    public const TYPES = ['MusicRelease' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicReleaseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
