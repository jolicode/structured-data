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

final class BreastfeedingWarningModel
{
    public const DESCRIPTION = 'Any precaution, guidance, contraindication, etc. related to this drug\'s use by breastfeeding mothers.';
    public const LABEL = 'breastfeedingWarning';
    public const NAME = 'schema:breastfeedingWarning';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
}
