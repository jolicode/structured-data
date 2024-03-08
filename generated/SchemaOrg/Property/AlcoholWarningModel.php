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

final class AlcoholWarningModel
{
    public const DESCRIPTION = 'Any precaution, guidance, contraindication, etc. related to consumption of alcohol while taking this drug.';
    public const LABEL = 'alcoholWarning';
    public const NAME = 'schema:alcoholWarning';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
