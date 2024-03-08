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

final class ProcessingTimeModel
{
    public const DESCRIPTION = 'Estimated processing time for the service using this channel.';
    public const LABEL = 'processingTime';
    public const NAME = 'schema:processingTime';
    public const VALUES = ['DurationModel' => 'SchemaOrg\\Type\\DurationModel'];
    public const TYPES = ['ServiceChannel' => 'SchemaOrg\\Type\\ServiceChannelModel'];
}
