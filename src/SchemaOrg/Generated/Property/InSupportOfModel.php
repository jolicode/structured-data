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

final class InSupportOfModel
{
    public const DESCRIPTION = 'Qualification, candidature, degree, application that Thesis supports.';
    public const LABEL = 'inSupportOf';
    public const NAME = 'schema:inSupportOf';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Thesis' => 'Jolicode\SchemaOrg\Type\ThesisModel'];
}
