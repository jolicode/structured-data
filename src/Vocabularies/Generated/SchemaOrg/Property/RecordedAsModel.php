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

final class RecordedAsModel
{
    public const DESCRIPTION = 'An audio recording of the work.';
    public const LABEL = 'recordedAs';
    public const NAME = 'schema:recordedAs';
    public const VALUES = ['MusicRecordingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel'];
    public const TYPES = ['MusicComposition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicCompositionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
