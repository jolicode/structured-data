<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

final class IntegerModel
{
    public const DESCRIPTION = 'Data type: Integer.';
    public const LABEL = 'Integer';
    public const NAME = 'schema:Integer';
    public const PARENTS = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct()
    {
    }
}
