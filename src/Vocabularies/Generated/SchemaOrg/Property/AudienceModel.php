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

final class AudienceModel
{
    public const DESCRIPTION = 'An intended audience, i.e. a group for whom something was created.';
    public const LABEL = 'audience';
    public const NAME = 'schema:audience';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudienceModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'LodgingBusiness' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingBusinessModel', 'PlayAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlayActionModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
