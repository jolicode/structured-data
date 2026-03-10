<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Type;

use Jolicode\Vocabularies\SchemaOrg\Property;

final class PronounceableTextModel
{
    public const DESCRIPTION = 'Data type: PronounceableText.';
    public const LABEL = 'PronounceableText';
    public const NAME = 'schema:PronounceableText';
    public const PARENTS = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2108'];

    public function __construct(
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\PhoneticTextModel $phoneticText = null,
        public ?Property\SpeechToTextMarkupModel $speechToTextMarkup = null,
        public ?Property\TextValueModel $textValue = null,
    ) {
    }
}
