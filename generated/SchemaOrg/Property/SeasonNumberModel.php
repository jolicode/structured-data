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

final class SeasonNumberModel
{
    public const DESCRIPTION = 'Position of the season within an ordered group of seasons.';
    public const LABEL = 'seasonNumber';
    public const NAME = 'schema:seasonNumber';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel'];
}
