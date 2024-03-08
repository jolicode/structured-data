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

final class EligibleTransactionVolumeModel
{
    public const DESCRIPTION = 'The transaction volume, in a monetary unit, for which the offer or price specification is valid, e.g. for indicating a minimal purchasing volume, to express free shipping above a certain order volume, or to limit the acceptance of credit cards to purchases to a certain minimal amount.';
    public const LABEL = 'eligibleTransactionVolume';
    public const NAME = 'schema:eligibleTransactionVolume';
    public const VALUES = ['PriceSpecificationModel' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'PriceSpecification' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
}
