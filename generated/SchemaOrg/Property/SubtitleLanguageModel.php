<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SubtitleLanguageModel
{
    public const DESCRIPTION = 'Languages in which subtitles/captions are available, in [IETF BCP 47 standard format](http://tools.ietf.org/html/bcp47).';
    public const LABEL = 'subtitleLanguage';
    public const NAME = 'schema:subtitleLanguage';
    public const VALUES = ['LanguageModel' => 'SchemaOrg\Type\LanguageModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastEvent' => 'SchemaOrg\Type\BroadcastEventModel', 'Movie' => 'SchemaOrg\Type\MovieModel', 'ScreeningEvent' => 'SchemaOrg\Type\ScreeningEventModel', 'TVEpisode' => 'SchemaOrg\Type\TVEpisodeModel'];
}
