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

final class IsStoreOnModel
{
    public const DESCRIPTION = 'The eCommerce marketplace this online store is on.';
    public const LABEL = 'isStoreOn';
    public const NAME = 'schema:isStoreOn';
    public const VALUES = ['OnlineMarketplaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OnlineMarketplaceModel'];
    public const TYPES = ['OnlineStore' => 'Jolicode\Vocabularies\SchemaOrg\Type\OnlineStoreModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
