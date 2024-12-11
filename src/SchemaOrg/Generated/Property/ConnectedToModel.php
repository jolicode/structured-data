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

final class ConnectedToModel
{
    public const DESCRIPTION = 'Other anatomical structures to which this structure is connected.';
    public const LABEL = 'connectedTo';
    public const NAME = 'schema:connectedTo';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
}
