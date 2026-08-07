<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class TranslationOfWorkModel
{
    public const DESCRIPTION = 'The work that this work has been translated from. E.g. 物种起源 is a translationOf “On the Origin of Species”.';
    public const LABEL = 'translationOfWork';
    public const NAME = 'schema:translationOfWork';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://bib.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
