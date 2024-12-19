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

final class CreditedToModel
{
    public const DESCRIPTION = 'The group the release is credited to if different than the byArtist. For example, Red and Blue is credited to "Stefani Germanotta Band", but by Lady Gaga.';
    public const LABEL = 'creditedTo';
    public const NAME = 'schema:creditedTo';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['MusicRelease' => 'Jolicode\SchemaOrg\Type\MusicReleaseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
