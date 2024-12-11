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

final class IswcCodeModel
{
    public const DESCRIPTION = 'The International Standard Musical Work Code for the composition.';
    public const LABEL = 'iswcCode';
    public const NAME = 'schema:iswcCode';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MusicComposition' => 'Jolicode\SchemaOrg\Type\MusicCompositionModel'];
}
