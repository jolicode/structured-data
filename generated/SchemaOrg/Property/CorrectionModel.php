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

final class CorrectionModel
{
    public const DESCRIPTION = 'Indicates a correction to a [[CreativeWork]], either via a [[CorrectionComment]], textually or in another document.';
    public const LABEL = 'correction';
    public const NAME = 'schema:correction';
    public const VALUES = ['CorrectionCommentModel' => 'SchemaOrg\\Type\\CorrectionCommentModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
