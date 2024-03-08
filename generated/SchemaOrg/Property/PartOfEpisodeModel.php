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

final class PartOfEpisodeModel
{
    public const DESCRIPTION = 'The episode to which this clip belongs.';
    public const LABEL = 'partOfEpisode';
    public const NAME = 'schema:partOfEpisode';
    public const VALUES = ['EpisodeModel' => 'SchemaOrg\\Type\\EpisodeModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\\Type\\ClipModel'];
}
