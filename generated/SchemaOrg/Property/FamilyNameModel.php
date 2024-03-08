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

final class FamilyNameModel
{
    public const DESCRIPTION = 'Family name. In the U.S., the last name of a Person.';
    public const LABEL = 'familyName';
    public const NAME = 'schema:familyName';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
