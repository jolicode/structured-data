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

final class CorrectionModel
{
    public const DESCRIPTION = 'Indicates a correction to a [[CreativeWork]], either via a [[CorrectionComment]], textually or in another document.';
    public const LABEL = 'correction';
    public const NAME = 'schema:correction';
    public const VALUES = ['CorrectionCommentModel' => 'Jolicode\SchemaOrg\Type\CorrectionCommentModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
