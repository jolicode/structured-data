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

final class PrescriptionStatusModel
{
    public const DESCRIPTION = 'Indicates the status of drug prescription, e.g. local catalogs classifications or whether the drug is available by prescription or over-the-counter, etc.';
    public const LABEL = 'prescriptionStatus';
    public const NAME = 'schema:prescriptionStatus';
    public const VALUES = ['DrugPrescriptionStatusModel' => 'Jolicode\SchemaOrg\Type\DrugPrescriptionStatusModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
