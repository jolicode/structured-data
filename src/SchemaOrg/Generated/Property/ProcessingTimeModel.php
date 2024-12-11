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

final class ProcessingTimeModel
{
    public const DESCRIPTION = 'Estimated processing time for the service using this channel.';
    public const LABEL = 'processingTime';
    public const NAME = 'schema:processingTime';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['ServiceChannel' => 'Jolicode\SchemaOrg\Type\ServiceChannelModel'];
}
