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

final class PregnancyWarningModel
{
    public const DESCRIPTION = 'Any precaution, guidance, contraindication, etc. related to this drug\'s use during pregnancy.';
    public const LABEL = 'pregnancyWarning';
    public const NAME = 'schema:pregnancyWarning';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
