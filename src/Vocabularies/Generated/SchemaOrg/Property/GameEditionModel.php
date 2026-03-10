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

final class GameEditionModel
{
    public const DESCRIPTION = 'The edition of a video game.';
    public const LABEL = 'gameEdition';
    public const NAME = 'schema:gameEdition';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['VideoGame' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
