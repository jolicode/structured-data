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

final class MakesOfferModel
{
    public const DESCRIPTION = 'A pointer to products or services offered by the organization or person.';
    public const LABEL = 'makesOffer';
    public const NAME = 'schema:makesOffer';
    public const VALUES = ['OfferModel' => 'SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
