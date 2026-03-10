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

final class AlternativeOfModel
{
    public const DESCRIPTION = 'Another gene which is a variation of this one.';
    public const LABEL = 'alternativeOf';
    public const NAME = 'schema:alternativeOf';
    public const VALUES = ['GeneModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeneModel'];
    public const TYPES = ['Gene' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeneModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
