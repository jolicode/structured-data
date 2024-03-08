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

final class PrescribingInfoModel
{
    public const DESCRIPTION = 'Link to prescribing information for the drug.';
    public const LABEL = 'prescribingInfo';
    public const NAME = 'schema:prescribingInfo';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
