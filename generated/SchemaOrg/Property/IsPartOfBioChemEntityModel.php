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

final class IsPartOfBioChemEntityModel
{
    public const DESCRIPTION = 'Indicates a BioChemEntity that is (in some sense) a part of this BioChemEntity. ';
    public const LABEL = 'isPartOfBioChemEntity';
    public const NAME = 'schema:isPartOfBioChemEntity';
    public const VALUES = ['BioChemEntityModel' => 'SchemaOrg\Type\BioChemEntityModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel'];
}
