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

final class MaterialExtentModel
{
    public const DESCRIPTION = 'The quantity of the materials being described or an expression of the physical space they occupy.';
    public const LABEL = 'materialExtent';
    public const NAME = 'schema:materialExtent';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
