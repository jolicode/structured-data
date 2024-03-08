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

final class SizeSystemModel
{
    public const DESCRIPTION = 'The size system used to identify a product\'s size. Typically either a standard (for example, "GS1" or "ISO-EN13402"), country code (for example "US" or "JP"), or a measuring system (for example "Metric" or "Imperial").';
    public const LABEL = 'sizeSystem';
    public const NAME = 'schema:sizeSystem';
    public const VALUES = ['SizeSystemEnumerationModel' => 'SchemaOrg\\Type\\SizeSystemEnumerationModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['SizeSpecification' => 'SchemaOrg\\Type\\SizeSpecificationModel'];
}
