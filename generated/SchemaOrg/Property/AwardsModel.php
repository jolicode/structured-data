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

final class AwardsModel
{
    public const DESCRIPTION = 'Awards won by or for this item.';
    public const LABEL = 'awards';
    public const NAME = 'schema:awards';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Person' => 'SchemaOrg\\Type\\PersonModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
