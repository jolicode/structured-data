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

final class FirstAppearanceModel
{
    public const DESCRIPTION = 'Indicates the first known occurrence of a [[Claim]] in some [[CreativeWork]].';
    public const LABEL = 'firstAppearance';
    public const NAME = 'schema:firstAppearance';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['Claim' => 'SchemaOrg\\Type\\ClaimModel'];
}
