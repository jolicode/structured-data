<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class AppearanceModel
{
    public const DESCRIPTION = 'Indicates an occurrence of a [[Claim]] in some [[CreativeWork]].';
    public const LABEL = 'appearance';
    public const NAME = 'schema:appearance';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Claim' => 'Jolicode\Vocabularies\SchemaOrg\Type\ClaimModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
