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

final class DrugUnitModel
{
    public const DESCRIPTION = 'The unit in which the drug is measured, e.g. \'5 mg tablet\'.';
    public const LABEL = 'drugUnit';
    public const NAME = 'schema:drugUnit';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugCost' => 'Jolicode\SchemaOrg\Type\DrugCostModel', 'Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
