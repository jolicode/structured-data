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

final class AwardModel
{
    public const DESCRIPTION = 'An award won by or for this item.';
    public const LABEL = 'award';
    public const NAME = 'schema:award';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Person' => 'SchemaOrg\\Type\\PersonModel', 'Product' => 'SchemaOrg\\Type\\ProductModel', 'Service' => 'SchemaOrg\\Type\\ServiceModel'];
}
