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

final class BioChemSimilarityModel
{
    public const DESCRIPTION = 'A similar BioChemEntity, e.g., obtained by fingerprint similarity algorithms.';
    public const LABEL = 'bioChemSimilarity';
    public const NAME = 'schema:bioChemSimilarity';
    public const VALUES = ['BioChemEntityModel' => 'SchemaOrg\Type\BioChemEntityModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel'];
}
