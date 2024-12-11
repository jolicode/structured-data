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

final class VolumeNumberModel
{
    public const DESCRIPTION = 'Identifies the volume of publication or multi-part work; for example, "iii" or "2".';
    public const LABEL = 'volumeNumber';
    public const NAME = 'schema:volumeNumber';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PublicationVolume' => 'Jolicode\SchemaOrg\Type\PublicationVolumeModel'];
}
