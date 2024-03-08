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

final class MusicArrangementModel
{
    public const DESCRIPTION = 'An arrangement derived from the composition.';
    public const LABEL = 'musicArrangement';
    public const NAME = 'schema:musicArrangement';
    public const VALUES = ['MusicCompositionModel' => 'SchemaOrg\Type\MusicCompositionModel'];
    public const TYPES = ['MusicComposition' => 'SchemaOrg\Type\MusicCompositionModel'];
}
