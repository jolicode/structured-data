<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ExpectsAcceptanceOfModel
{
    public const DESCRIPTION = 'An Offer which must be accepted before the user can perform the Action. For example, the user may need to buy a movie before being able to watch it.';
    public const LABEL = 'expectsAcceptanceOf';
    public const NAME = 'schema:expectsAcceptanceOf';
    public const VALUES = ['OfferModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ActionAccessSpecificationModel', 'ConsumeAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ConsumeActionModel', 'MediaSubscription' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MediaSubscriptionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
