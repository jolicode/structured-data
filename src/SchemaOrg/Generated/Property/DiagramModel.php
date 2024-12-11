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

final class DiagramModel
{
    public const DESCRIPTION = 'An image containing a diagram that illustrates the structure and/or its component substructures and/or connections with other structures.';
    public const LABEL = 'diagram';
    public const NAME = 'schema:diagram';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\SchemaOrg\Type\ImageObjectModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel'];
}
