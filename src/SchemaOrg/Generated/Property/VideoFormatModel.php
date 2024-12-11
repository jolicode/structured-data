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

final class VideoFormatModel
{
    public const DESCRIPTION = 'The type of screening or video broadcast used (e.g. IMAX, 3D, SD, HD, etc.).';
    public const LABEL = 'videoFormat';
    public const NAME = 'schema:videoFormat';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastEvent' => 'Jolicode\SchemaOrg\Type\BroadcastEventModel', 'BroadcastService' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel', 'ScreeningEvent' => 'Jolicode\SchemaOrg\Type\ScreeningEventModel'];
}
