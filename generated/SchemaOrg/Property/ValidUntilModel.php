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

final class ValidUntilModel
{
    public const DESCRIPTION = 'The date when the item is no longer valid.';
    public const LABEL = 'validUntil';
    public const NAME = 'schema:validUntil';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel'];
    public const TYPES = ['Permit' => 'SchemaOrg\\Type\\PermitModel'];
}
