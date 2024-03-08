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

final class EncodesBioChemEntityModel
{
    public const DESCRIPTION = 'Another BioChemEntity encoded by this one. ';
    public const LABEL = 'encodesBioChemEntity';
    public const NAME = 'schema:encodesBioChemEntity';
    public const VALUES = ['BioChemEntityModel' => 'SchemaOrg\\Type\\BioChemEntityModel'];
    public const TYPES = ['Gene' => 'SchemaOrg\\Type\\GeneModel'];
}
