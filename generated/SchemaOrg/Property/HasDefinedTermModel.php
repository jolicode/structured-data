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

final class HasDefinedTermModel
{
    public const DESCRIPTION = 'A Defined Term contained in this term set.';
    public const LABEL = 'hasDefinedTerm';
    public const NAME = 'schema:hasDefinedTerm';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['DefinedTermSet' => 'SchemaOrg\Type\DefinedTermSetModel', 'Taxon' => 'SchemaOrg\Type\TaxonModel'];
}
