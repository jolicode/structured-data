<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class UsesDeviceModel
{
    public const DESCRIPTION = 'Device used to perform the test.';
    public const LABEL = 'usesDevice';
    public const NAME = 'schema:usesDevice';
    public const VALUES = ['MedicalDeviceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalDeviceModel'];
    public const TYPES = ['MedicalTest' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalTestModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
