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

final class TickerSymbolModel
{
    public const DESCRIPTION = 'The exchange traded instrument associated with a Corporation object. The tickerSymbol is expressed as an exchange and an instrument name separated by a space character. For the exchange component of the tickerSymbol attribute, we recommend using the controlled vocabulary of Market Identifier Codes (MIC) specified in ISO 15022.';
    public const LABEL = 'tickerSymbol';
    public const NAME = 'schema:tickerSymbol';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Corporation' => 'Jolicode\Vocabularies\SchemaOrg\Type\CorporationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
