<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class AudienceModel
{
    public const DESCRIPTION = 'An intended audience, i.e. a group for whom something was created.';
    public const LABEL = 'audience';
    public const NAME = 'schema:audience';
    public const VALUES = ['AudienceModel' => 'Jolicode\SchemaOrg\Type\AudienceModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel', 'PlayAction' => 'Jolicode\SchemaOrg\Type\PlayActionModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
