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

final class SupplyToModel
{
    public const DESCRIPTION = 'The area to which the artery supplies blood.';
    public const LABEL = 'supplyTo';
    public const NAME = 'schema:supplyTo';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\\Type\\AnatomicalStructureModel'];
    public const TYPES = ['Artery' => 'SchemaOrg\\Type\\ArteryModel'];
}
