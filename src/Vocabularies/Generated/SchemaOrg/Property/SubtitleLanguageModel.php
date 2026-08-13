<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class SubtitleLanguageModel
{
    public const DESCRIPTION = 'Languages in which subtitles/captions are available, in [IETF BCP 47 standard format](http://tools.ietf.org/html/bcp47).';
    public const LABEL = 'subtitleLanguage';
    public const NAME = 'schema:subtitleLanguage';
    public const VALUES = ['LanguageModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LanguageModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastEvent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastEventModel', 'Movie' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'ScreeningEvent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ScreeningEventModel', 'TVEpisode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TVEpisodeModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2110'];
    public const SUPERSEDED_BY = null;
}
