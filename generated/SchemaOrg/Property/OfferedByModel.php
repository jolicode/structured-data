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

final class OfferedByModel
{
    public const DESCRIPTION = 'A pointer to the organization or person making the offer.';
    public const LABEL = 'offeredBy';
    public const NAME = 'schema:offeredBy';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Offer' => 'SchemaOrg\\Type\\OfferModel'];
}
