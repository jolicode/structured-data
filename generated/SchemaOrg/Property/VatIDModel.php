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

final class VatIDModel
{
    public const DESCRIPTION = 'The Value-added Tax ID of the organization or person.';
    public const LABEL = 'vatID';
    public const NAME = 'schema:vatID';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
