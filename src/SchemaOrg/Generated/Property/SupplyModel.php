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

final class SupplyModel
{
    public const DESCRIPTION = 'A sub-property of instrument. A supply consumed when performing instructions or a direction.';
    public const LABEL = 'supply';
    public const NAME = 'schema:supply';
    public const VALUES = ['HowToSupplyModel' => 'Jolicode\SchemaOrg\Type\HowToSupplyModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowToDirection' => 'Jolicode\SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'Jolicode\SchemaOrg\Type\HowToModel'];
}
