<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class MusicGroupMemberModel
{
    public const DESCRIPTION = 'A member of a music group&#x2014;for example, John, Paul, George, or Ringo.';
    public const LABEL = 'musicGroupMember';
    public const NAME = 'schema:musicGroupMember';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['MusicGroup' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MusicGroupModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'member';
}
