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

final class OccupationLocationModel
{
    public const DESCRIPTION = ' The region/country for which this occupational description is appropriate. Note that educational requirements and qualifications can vary between jurisdictions.';
    public const LABEL = 'occupationLocation';
    public const NAME = 'schema:occupationLocation';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel'];
    public const TYPES = ['Occupation' => 'SchemaOrg\\Type\\OccupationModel'];
}
