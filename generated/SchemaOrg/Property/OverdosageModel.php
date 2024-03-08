<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class OverdosageModel
{
    public const DESCRIPTION = 'Any information related to overdose on a drug, including signs or symptoms, treatments, contact information for emergency response.';
    public const LABEL = 'overdosage';
    public const NAME = 'schema:overdosage';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\Type\DrugModel'];
}
