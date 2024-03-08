<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SupplyModel
{
    public const DESCRIPTION = 'A sub-property of instrument. A supply consumed when performing instructions or a direction.';
    public const LABEL = 'supply';
    public const NAME = 'schema:supply';
    public const VALUES = ['HowToSupplyModel' => 'SchemaOrg\Type\HowToSupplyModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowToDirection' => 'SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'SchemaOrg\Type\HowToModel'];
}
