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

final class EndorsersModel
{
    public const DESCRIPTION = 'People or organizations that endorse the plan.';
    public const LABEL = 'endorsers';
    public const NAME = 'schema:endorsers';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Diet' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DietModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
