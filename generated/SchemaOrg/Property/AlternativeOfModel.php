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

final class AlternativeOfModel
{
    public const DESCRIPTION = 'Another gene which is a variation of this one.';
    public const LABEL = 'alternativeOf';
    public const NAME = 'schema:alternativeOf';
    public const VALUES = ['GeneModel' => 'SchemaOrg\\Type\\GeneModel'];
    public const TYPES = ['Gene' => 'SchemaOrg\\Type\\GeneModel'];
}
