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

final class YieldModel
{
    public const DESCRIPTION = 'The quantity that results by performing instructions. For example, a paper airplane, 10 personalized candles.';
    public const LABEL = 'yield';
    public const NAME = 'schema:yield';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowTo' => 'Jolicode\SchemaOrg\Type\HowToModel'];
}
