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

final class AdditionalNameModel
{
    public const DESCRIPTION = 'An additional name for a Person, can be used for a middle name.';
    public const LABEL = 'additionalName';
    public const NAME = 'schema:additionalName';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
