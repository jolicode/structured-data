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

final class NumberOfBedsModel
{
    public const DESCRIPTION = 'The quantity of the given bed type available in the HotelRoom, Suite, House, or Apartment.';
    public const LABEL = 'numberOfBeds';
    public const NAME = 'schema:numberOfBeds';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['BedDetails' => 'SchemaOrg\\Type\\BedDetailsModel'];
}
