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

final class FloatModel
{
    public const DESCRIPTION = 'Data type: Floating number.';
    public const LABEL = 'Float';
    public const NAME = 'schema:Float';
    public const PARENTS = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct()
    {
    }
}
