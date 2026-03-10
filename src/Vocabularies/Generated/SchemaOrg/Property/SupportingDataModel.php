<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SupportingDataModel
{
    public const DESCRIPTION = 'Supporting data for a SoftwareApplication.';
    public const LABEL = 'supportingData';
    public const NAME = 'schema:supportingData';
    public const VALUES = ['DataFeedModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DataFeedModel'];
    public const TYPES = ['SoftwareApplication' => 'Jolicode\Vocabularies\SchemaOrg\Type\SoftwareApplicationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
