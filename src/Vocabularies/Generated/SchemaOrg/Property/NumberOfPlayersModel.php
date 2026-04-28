<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class NumberOfPlayersModel
{
    public const DESCRIPTION = 'Indicate how many people can play this game (minimum, maximum, or range).';
    public const LABEL = 'numberOfPlayers';
    public const NAME = 'schema:numberOfPlayers';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Game' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
