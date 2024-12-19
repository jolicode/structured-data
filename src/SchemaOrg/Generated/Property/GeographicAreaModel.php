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

final class GeographicAreaModel
{
    public const DESCRIPTION = 'The geographic area associated with the audience.';
    public const LABEL = 'geographicArea';
    public const NAME = 'schema:geographicArea';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['Audience' => 'Jolicode\SchemaOrg\Type\AudienceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
