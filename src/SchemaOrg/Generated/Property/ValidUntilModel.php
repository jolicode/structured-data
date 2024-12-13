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

final class ValidUntilModel
{
    public const DESCRIPTION = 'The date when the item is no longer valid.';
    public const LABEL = 'validUntil';
    public const NAME = 'schema:validUntil';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Permit' => 'Jolicode\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
