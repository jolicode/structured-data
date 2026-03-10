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

final class DrugClassModel
{
    public const DESCRIPTION = 'The class of drug this belongs to (e.g., statins).';
    public const LABEL = 'drugClass';
    public const NAME = 'schema:drugClass';
    public const VALUES = ['DrugClassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugClassModel'];
    public const TYPES = ['Drug' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
