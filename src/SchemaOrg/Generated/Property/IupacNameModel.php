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

final class IupacNameModel
{
    public const DESCRIPTION = 'Systematic method of naming chemical compounds as recommended by the International Union of Pure and Applied Chemistry (IUPAC).';
    public const LABEL = 'iupacName';
    public const NAME = 'schema:iupacName';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'Jolicode\SchemaOrg\Type\MolecularEntityModel'];
}
