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

final class HonorificPrefixModel
{
    public const DESCRIPTION = 'An honorific prefix preceding a Person\'s name such as Dr/Mrs/Mr.';
    public const LABEL = 'honorificPrefix';
    public const NAME = 'schema:honorificPrefix';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
