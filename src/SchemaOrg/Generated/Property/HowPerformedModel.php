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

final class HowPerformedModel
{
    public const DESCRIPTION = 'How the procedure is performed.';
    public const LABEL = 'howPerformed';
    public const NAME = 'schema:howPerformed';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalProcedure' => 'Jolicode\SchemaOrg\Type\MedicalProcedureModel'];
}
