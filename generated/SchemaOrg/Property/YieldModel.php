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

final class YieldModel
{
    public const DESCRIPTION = 'The quantity that results by performing instructions. For example, a paper airplane, 10 personalized candles.';
    public const LABEL = 'yield';
    public const NAME = 'schema:yield';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HowTo' => 'SchemaOrg\\Type\\HowToModel'];
}
