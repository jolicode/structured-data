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

final class DosageFormModel
{
    public const DESCRIPTION = 'A dosage form in which this drug/supplement is available, e.g. \'tablet\', \'suspension\', \'injection\'.';
    public const LABEL = 'dosageForm';
    public const NAME = 'schema:dosageForm';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
