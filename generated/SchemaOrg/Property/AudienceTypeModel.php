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

final class AudienceTypeModel
{
    public const DESCRIPTION = 'The target group associated with a given audience (e.g. veterans, car owners, musicians, etc.).';
    public const LABEL = 'audienceType';
    public const NAME = 'schema:audienceType';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Audience' => 'SchemaOrg\Type\AudienceModel'];
}
