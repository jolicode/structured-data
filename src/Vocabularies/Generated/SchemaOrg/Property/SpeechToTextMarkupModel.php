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

final class SpeechToTextMarkupModel
{
    public const DESCRIPTION = 'Form of markup used. eg. [SSML](https://www.w3.org/TR/speech-synthesis11) or [IPA](https://www.wikidata.org/wiki/Property:P898).';
    public const LABEL = 'speechToTextMarkup';
    public const NAME = 'schema:speechToTextMarkup';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PronounceableText' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PronounceableTextModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2108'];
    public const SUPERSEDED_BY = null;
}
