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

final class PartOfSeasonModel
{
    public const DESCRIPTION = 'The season to which this episode belongs.';
    public const LABEL = 'partOfSeason';
    public const NAME = 'schema:partOfSeason';
    public const VALUES = ['CreativeWorkSeasonModel' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\\Type\\ClipModel', 'Episode' => 'SchemaOrg\\Type\\EpisodeModel'];
}
