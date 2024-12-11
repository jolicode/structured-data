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

final class SupplyToModel
{
    public const DESCRIPTION = 'The area to which the artery supplies blood.';
    public const LABEL = 'supplyTo';
    public const NAME = 'schema:supplyTo';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Artery' => 'Jolicode\SchemaOrg\Type\ArteryModel'];
}
