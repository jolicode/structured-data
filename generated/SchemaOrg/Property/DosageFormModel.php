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

final class DosageFormModel
{
    public const DESCRIPTION = 'A dosage form in which this drug/supplement is available, e.g. \'tablet\', \'suspension\', \'injection\'.';
    public const LABEL = 'dosageForm';
    public const NAME = 'schema:dosageForm';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
