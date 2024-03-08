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

final class ProvidesServiceModel
{
    public const DESCRIPTION = 'The service provided by this channel.';
    public const LABEL = 'providesService';
    public const NAME = 'schema:providesService';
    public const VALUES = ['ServiceModel' => 'SchemaOrg\\Type\\ServiceModel'];
    public const TYPES = ['ServiceChannel' => 'SchemaOrg\\Type\\ServiceChannelModel'];
}
