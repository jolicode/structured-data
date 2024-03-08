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

final class HonorificSuffixModel
{
    public const DESCRIPTION = 'An honorific suffix following a Person\'s name such as M.D./PhD/MSCSW.';
    public const LABEL = 'honorificSuffix';
    public const NAME = 'schema:honorificSuffix';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
