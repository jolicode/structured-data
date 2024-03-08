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

final class CvdNumC19DiedModel
{
    public const DESCRIPTION = 'numc19died - DEATHS: Patients with suspected or confirmed COVID-19 who died in the hospital, ED, or any overflow location.';
    public const LABEL = 'cvdNumC19Died';
    public const NAME = 'schema:cvdNumC19Died';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\\Type\\CDCPMDRecordModel'];
}
