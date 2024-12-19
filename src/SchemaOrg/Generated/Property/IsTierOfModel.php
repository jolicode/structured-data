<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class IsTierOfModel
{
    public const DESCRIPTION = 'The member program this tier is a part of.';
    public const LABEL = 'isTierOf';
    public const NAME = 'schema:isTierOf';
    public const VALUES = ['MemberProgramModel' => 'Jolicode\SchemaOrg\Type\MemberProgramModel'];
    public const TYPES = ['MemberProgramTier' => 'Jolicode\SchemaOrg\Type\MemberProgramTierModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
