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

final class ServiceAudienceModel
{
    public const DESCRIPTION = 'The audience eligible for this service.';
    public const LABEL = 'serviceAudience';
    public const NAME = 'schema:serviceAudience';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\Type\AudienceModel'];
    public const TYPES = ['Service' => 'SchemaOrg\Type\ServiceModel'];
}
