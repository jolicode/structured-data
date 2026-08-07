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

final class ContactPointsModel
{
    public const DESCRIPTION = 'A contact point for a person or organization.';
    public const LABEL = 'contactPoints';
    public const NAME = 'schema:contactPoints';
    public const VALUES = ['ContactPointModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'contactPoint';
}
