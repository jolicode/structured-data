<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ContributorModel
{
    public const DESCRIPTION = 'A secondary contributor to the CreativeWork or Event.';
    public const LABEL = 'contributor';
    public const NAME = 'schema:contributor';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
