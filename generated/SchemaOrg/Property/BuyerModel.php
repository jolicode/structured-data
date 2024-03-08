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

final class BuyerModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant/person/organization that bought the object.';
    public const LABEL = 'buyer';
    public const NAME = 'schema:buyer';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['SellAction' => 'SchemaOrg\\Type\\SellActionModel'];
}
