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

final class RelatedDrugModel
{
    public const DESCRIPTION = 'Any other drug related to this one, for example commonly-prescribed alternatives.';
    public const LABEL = 'relatedDrug';
    public const NAME = 'schema:relatedDrug';
    public const VALUES = ['DrugModel' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
