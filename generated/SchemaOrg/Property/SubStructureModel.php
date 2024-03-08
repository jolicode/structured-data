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

final class SubStructureModel
{
    public const DESCRIPTION = 'Component (sub-)structure(s) that comprise this anatomical structure.';
    public const LABEL = 'subStructure';
    public const NAME = 'schema:subStructure';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['AnatomicalStructure' => 'SchemaOrg\Type\AnatomicalStructureModel'];
}
