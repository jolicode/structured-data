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

final class HoursAvailableModel
{
    public const DESCRIPTION = 'The hours during which this service or contact is available.';
    public const LABEL = 'hoursAvailable';
    public const NAME = 'schema:hoursAvailable';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'SchemaOrg\\Type\\OpeningHoursSpecificationModel'];
    public const TYPES = ['ContactPoint' => 'SchemaOrg\\Type\\ContactPointModel', 'LocationFeatureSpecification' => 'SchemaOrg\\Type\\LocationFeatureSpecificationModel', 'Service' => 'SchemaOrg\\Type\\ServiceModel'];
}
