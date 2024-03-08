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

final class FirstPerformanceModel
{
    public const DESCRIPTION = 'The date and place the work was first performed.';
    public const LABEL = 'firstPerformance';
    public const NAME = 'schema:firstPerformance';
    public const VALUES = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const TYPES = ['MusicComposition' => 'SchemaOrg\\Type\\MusicCompositionModel'];
}
