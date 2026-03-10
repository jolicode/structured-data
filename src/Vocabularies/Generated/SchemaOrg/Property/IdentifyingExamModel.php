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

final class IdentifyingExamModel
{
    public const DESCRIPTION = 'A physical examination that can identify this sign.';
    public const LABEL = 'identifyingExam';
    public const NAME = 'schema:identifyingExam';
    public const VALUES = ['PhysicalExamModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicalExamModel'];
    public const TYPES = ['MedicalSign' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalSignModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
