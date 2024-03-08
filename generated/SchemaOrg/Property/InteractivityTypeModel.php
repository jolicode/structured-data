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

final class InteractivityTypeModel
{
    public const DESCRIPTION = 'The predominant mode of learning supported by the learning resource. Acceptable values are \'active\', \'expositive\', or \'mixed\'.';
    public const LABEL = 'interactivityType';
    public const NAME = 'schema:interactivityType';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
