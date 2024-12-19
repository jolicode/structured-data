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

final class MusicCompositionFormModel
{
    public const DESCRIPTION = 'The type of composition (e.g. overture, sonata, symphony, etc.).';
    public const LABEL = 'musicCompositionForm';
    public const NAME = 'schema:musicCompositionForm';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MusicComposition' => 'Jolicode\SchemaOrg\Type\MusicCompositionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
