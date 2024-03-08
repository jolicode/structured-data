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

final class DrainsToModel
{
    public const DESCRIPTION = 'The vasculature that the vein drains into.';
    public const LABEL = 'drainsTo';
    public const NAME = 'schema:drainsTo';
    public const VALUES = ['VesselModel' => 'SchemaOrg\\Type\\VesselModel'];
    public const TYPES = ['Vein' => 'SchemaOrg\\Type\\VeinModel'];
}
