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

final class SupportingDataModel
{
    public const DESCRIPTION = 'Supporting data for a SoftwareApplication.';
    public const LABEL = 'supportingData';
    public const NAME = 'schema:supportingData';
    public const VALUES = ['DataFeedModel' => 'SchemaOrg\Type\DataFeedModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
