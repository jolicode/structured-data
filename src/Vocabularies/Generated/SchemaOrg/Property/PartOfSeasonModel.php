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

final class PartOfSeasonModel
{
    public const DESCRIPTION = 'The season to which this episode belongs.';
    public const LABEL = 'partOfSeason';
    public const NAME = 'schema:partOfSeason';
    public const VALUES = ['CreativeWorkSeasonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeasonModel'];
    public const TYPES = ['Clip' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'Episode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
