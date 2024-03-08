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

final class IsEncodedByBioChemEntityModel
{
    public const DESCRIPTION = 'Another BioChemEntity encoding by this one.';
    public const LABEL = 'isEncodedByBioChemEntity';
    public const NAME = 'schema:isEncodedByBioChemEntity';
    public const VALUES = ['GeneModel' => 'SchemaOrg\Type\GeneModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel'];
}
