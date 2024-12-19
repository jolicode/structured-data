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

final class PregnancyCategoryModel
{
    public const DESCRIPTION = 'Pregnancy category of this drug.';
    public const LABEL = 'pregnancyCategory';
    public const NAME = 'schema:pregnancyCategory';
    public const VALUES = ['DrugPregnancyCategoryModel' => 'Jolicode\SchemaOrg\Type\DrugPregnancyCategoryModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
