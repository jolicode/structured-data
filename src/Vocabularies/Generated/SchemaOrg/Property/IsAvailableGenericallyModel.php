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

final class IsAvailableGenericallyModel
{
    public const DESCRIPTION = 'True if the drug is available in a generic form (regardless of name).';
    public const LABEL = 'isAvailableGenerically';
    public const NAME = 'schema:isAvailableGenerically';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['Drug' => 'Jolicode\Vocabularies\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
