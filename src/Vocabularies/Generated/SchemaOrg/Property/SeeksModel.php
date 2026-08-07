<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class SeeksModel
{
    public const DESCRIPTION = 'A pointer to products or services sought by the organization or person (demand).';
    public const LABEL = 'seeks';
    public const NAME = 'schema:seeks';
    public const VALUES = ['DemandModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
