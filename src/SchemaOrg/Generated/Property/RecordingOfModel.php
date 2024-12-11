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

final class RecordingOfModel
{
    public const DESCRIPTION = 'The composition this track is a recording of.';
    public const LABEL = 'recordingOf';
    public const NAME = 'schema:recordingOf';
    public const VALUES = ['MusicCompositionModel' => 'Jolicode\SchemaOrg\Type\MusicCompositionModel'];
    public const TYPES = ['MusicRecording' => 'Jolicode\SchemaOrg\Type\MusicRecordingModel'];
}
