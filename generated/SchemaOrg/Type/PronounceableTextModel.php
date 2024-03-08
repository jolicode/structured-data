<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class PronounceableTextModel
{
    public const DESCRIPTION = 'Data type: PronounceableText.';
    public const LABEL = 'PronounceableText';
    public const NAME = 'schema:PronounceableText';
    public const PARENTS = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\PhoneticTextModel $phoneticText = null,
        public ?Property\SpeechToTextMarkupModel $speechToTextMarkup = null,
        public ?Property\TextValueModel $textValue = null,
    ) {
    }
}
