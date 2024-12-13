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

final class OfferCountModel
{
    public const DESCRIPTION = 'The number of offers for the product.';
    public const LABEL = 'offerCount';
    public const NAME = 'schema:offerCount';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['AggregateOffer' => 'Jolicode\SchemaOrg\Type\AggregateOfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
