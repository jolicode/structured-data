<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class AccessModeSufficientModel
{
    public const DESCRIPTION = 'A list of single or combined access modes that are sufficient to understand all the intellectual content of a resource, including any adaptations. Values should be drawn from the [approved vocabulary](https://www.w3.org/2021/a11y-discov-vocab/latest/#accessModeSufficient-vocabulary).';
    public const LABEL = 'accessModeSufficient';
    public const NAME = 'schema:accessModeSufficient';
    public const VALUES = ['ItemListModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ItemListModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1100'];
    public const SUPERSEDED_BY = null;
}
