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

final class IsrcCodeModel
{
    public const DESCRIPTION = 'The International Standard Recording Code for the recording.';
    public const LABEL = 'isrcCode';
    public const NAME = 'schema:isrcCode';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MusicRecording' => 'Jolicode\SchemaOrg\Type\MusicRecordingModel'];
}
