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

final class ChildTaxonModel
{
    public const DESCRIPTION = 'Closest child taxa of the taxon in question.';
    public const LABEL = 'childTaxon';
    public const NAME = 'schema:childTaxon';
    public const VALUES = ['TaxonModel' => 'SchemaOrg\\Type\\TaxonModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Taxon' => 'SchemaOrg\\Type\\TaxonModel'];
}
