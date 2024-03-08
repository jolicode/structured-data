<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class WorkPresentedModel
{
    public const DESCRIPTION = 'The movie presented during this event.';
    public const LABEL = 'workPresented';
    public const NAME = 'schema:workPresented';
    public const VALUES = ['MovieModel' => 'SchemaOrg\Type\MovieModel'];
    public const TYPES = ['ScreeningEvent' => 'SchemaOrg\Type\ScreeningEventModel'];
}
