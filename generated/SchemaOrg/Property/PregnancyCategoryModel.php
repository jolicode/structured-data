<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PregnancyCategoryModel
{
    public const DESCRIPTION = 'Pregnancy category of this drug.';
    public const LABEL = 'pregnancyCategory';
    public const NAME = 'schema:pregnancyCategory';
    public const VALUES = ['DrugPregnancyCategoryModel' => 'SchemaOrg\\Type\\DrugPregnancyCategoryModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
