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

final class IssuedThroughModel
{
    public const DESCRIPTION = 'The service through which the permit was granted.';
    public const LABEL = 'issuedThrough';
    public const NAME = 'schema:issuedThrough';
    public const VALUES = ['ServiceModel' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['Permit' => 'Jolicode\SchemaOrg\Type\PermitModel'];
}
