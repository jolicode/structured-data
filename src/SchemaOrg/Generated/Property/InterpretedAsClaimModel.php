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

final class InterpretedAsClaimModel
{
    public const DESCRIPTION = 'Used to indicate a specific claim contained, implied, translated or refined from the content of a [[MediaObject]] or other [[CreativeWork]]. The interpreting party can be indicated using [[claimInterpreter]].';
    public const LABEL = 'interpretedAsClaim';
    public const NAME = 'schema:interpretedAsClaim';
    public const VALUES = ['ClaimModel' => 'Jolicode\SchemaOrg\Type\ClaimModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
