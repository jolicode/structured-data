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

final class MusicGroupMemberModel
{
    public const DESCRIPTION = 'A member of a music group&#x2014;for example, John, Paul, George, or Ringo.';
    public const LABEL = 'musicGroupMember';
    public const NAME = 'schema:musicGroupMember';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['MusicGroup' => 'SchemaOrg\Type\MusicGroupModel'];
}
