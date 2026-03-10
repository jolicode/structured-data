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

final class SubtitleLanguageModel
{
    public const DESCRIPTION = 'Languages in which subtitles/captions are available, in [IETF BCP 47 standard format](http://tools.ietf.org/html/bcp47).';
    public const LABEL = 'subtitleLanguage';
    public const NAME = 'schema:subtitleLanguage';
    public const VALUES = ['LanguageModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\LanguageModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\BroadcastEventModel', 'Movie' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieModel', 'ScreeningEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\ScreeningEventModel', 'TVEpisode' => 'Jolicode\Vocabularies\SchemaOrg\Type\TVEpisodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
