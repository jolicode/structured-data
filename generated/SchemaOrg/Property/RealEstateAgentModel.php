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

final class RealEstateAgentModel
{
    public const DESCRIPTION = 'A sub property of participant. The real estate agent involved in the action.';
    public const LABEL = 'realEstateAgent';
    public const NAME = 'schema:realEstateAgent';
    public const VALUES = ['RealEstateAgentModel' => 'SchemaOrg\\Type\\RealEstateAgentModel'];
    public const TYPES = ['RentAction' => 'SchemaOrg\\Type\\RentActionModel'];
}
