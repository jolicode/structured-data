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

final class IncludedCompositionModel
{
    public const DESCRIPTION = 'Smaller compositions included in this work (e.g. a movement in a symphony).';
    public const LABEL = 'includedComposition';
    public const NAME = 'schema:includedComposition';
    public const VALUES = ['MusicCompositionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicCompositionModel'];
    public const TYPES = ['MusicComposition' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicCompositionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
