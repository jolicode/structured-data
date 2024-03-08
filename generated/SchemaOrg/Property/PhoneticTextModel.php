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

final class PhoneticTextModel
{
    public const DESCRIPTION = 'Representation of a text [[textValue]] using the specified [[speechToTextMarkup]]. For example the city name of Houston in IPA: /ˈhjuːstən/.';
    public const LABEL = 'phoneticText';
    public const NAME = 'schema:phoneticText';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['PronounceableText' => 'SchemaOrg\Type\PronounceableTextModel'];
}
