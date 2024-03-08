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

final class DescriptionModel
{
    public const DESCRIPTION = 'A description of the item.';
    public const LABEL = 'description';
    public const NAME = 'schema:description';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'TextObjectModel' => 'SchemaOrg\\Type\\TextObjectModel'];
    public const TYPES = ['Thing' => 'SchemaOrg\\Type\\ThingModel'];
}
