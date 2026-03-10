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

final class IsBasedOnModel
{
    public const DESCRIPTION = 'A resource from which this work is derived or from which it is a modification or adaptation.';
    public const LABEL = 'isBasedOn';
    public const NAME = 'schema:isBasedOn';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'ProductModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
