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

final class CauseOfModel
{
    public const DESCRIPTION = 'The condition, complication, symptom, sign, etc. caused.';
    public const LABEL = 'causeOf';
    public const NAME = 'schema:causeOf';
    public const VALUES = ['MedicalEntityModel' => 'SchemaOrg\\Type\\MedicalEntityModel'];
    public const TYPES = ['MedicalCause' => 'SchemaOrg\\Type\\MedicalCauseModel'];
}
