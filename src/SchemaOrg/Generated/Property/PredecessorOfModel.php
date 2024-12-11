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

final class PredecessorOfModel
{
    public const DESCRIPTION = 'A pointer from a previous, often discontinued variant of the product to its newer variant.';
    public const LABEL = 'predecessorOf';
    public const NAME = 'schema:predecessorOf';
    public const VALUES = ['ProductModelModel' => 'Jolicode\SchemaOrg\Type\ProductModelModel'];
    public const TYPES = ['ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModelModel'];
}
