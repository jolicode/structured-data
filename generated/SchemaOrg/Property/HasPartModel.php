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

final class HasPartModel
{
    public const DESCRIPTION = 'Indicates an item or CreativeWork that is part of this item, or CreativeWork (in some sense).';
    public const LABEL = 'hasPart';
    public const NAME = 'schema:hasPart';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
