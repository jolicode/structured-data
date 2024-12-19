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

final class DrainsToModel
{
    public const DESCRIPTION = 'The vasculature that the vein drains into.';
    public const LABEL = 'drainsTo';
    public const NAME = 'schema:drainsTo';
    public const VALUES = ['VesselModel' => 'Jolicode\SchemaOrg\Type\VesselModel'];
    public const TYPES = ['Vein' => 'Jolicode\SchemaOrg\Type\VeinModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
