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

final class ComprisedOfModel
{
    public const DESCRIPTION = 'Specifying something physically contained by something else. Typically used here for the underlying anatomical structures, such as organs, that comprise the anatomical system.';
    public const LABEL = 'comprisedOf';
    public const NAME = 'schema:comprisedOf';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'SchemaOrg\Type\AnatomicalSystemModel'];
    public const TYPES = ['AnatomicalSystem' => 'SchemaOrg\Type\AnatomicalSystemModel'];
}
