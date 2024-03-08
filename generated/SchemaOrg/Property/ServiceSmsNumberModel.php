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

final class ServiceSmsNumberModel
{
    public const DESCRIPTION = 'The number to access the service by text message.';
    public const LABEL = 'serviceSmsNumber';
    public const NAME = 'schema:serviceSmsNumber';
    public const VALUES = ['ContactPointModel' => 'SchemaOrg\\Type\\ContactPointModel'];
    public const TYPES = ['ServiceChannel' => 'SchemaOrg\\Type\\ServiceChannelModel'];
}
