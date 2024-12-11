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

final class ClaimInterpreterModel
{
    public const DESCRIPTION = 'For a [[Claim]] interpreted from [[MediaObject]] content
    sed to indicate a claim contained, implied or refined from the content of a [[MediaObject]].';
    public const LABEL = 'claimInterpreter';
    public const NAME = 'schema:claimInterpreter';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Claim' => 'Jolicode\SchemaOrg\Type\ClaimModel'];
}
