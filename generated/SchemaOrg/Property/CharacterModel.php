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

final class CharacterModel
{
    public const DESCRIPTION = 'Fictional person connected with a creative work.';
    public const LABEL = 'character';
    public const NAME = 'schema:character';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
