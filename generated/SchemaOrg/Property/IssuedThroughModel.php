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

final class IssuedThroughModel
{
    public const DESCRIPTION = 'The service through which the permit was granted.';
    public const LABEL = 'issuedThrough';
    public const NAME = 'schema:issuedThrough';
    public const VALUES = ['ServiceModel' => 'SchemaOrg\\Type\\ServiceModel'];
    public const TYPES = ['Permit' => 'SchemaOrg\\Type\\PermitModel'];
}
