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

final class FollowupModel
{
    public const DESCRIPTION = 'Typical or recommended followup care after the procedure is performed.';
    public const LABEL = 'followup';
    public const NAME = 'schema:followup';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalProcedure' => 'SchemaOrg\Type\MedicalProcedureModel'];
}
