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

final class HasStoreModel
{
    public const DESCRIPTION = 'An eCommerce store part of an online marketplace.';
    public const LABEL = 'hasStore';
    public const NAME = 'schema:hasStore';
    public const VALUES = ['OnlineStoreModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OnlineStoreModel'];
    public const TYPES = ['OnlineMarketplace' => 'Jolicode\Vocabularies\SchemaOrg\Type\OnlineMarketplaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
