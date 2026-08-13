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

final class CssSelectorModel
{
    public const DESCRIPTION = 'A CSS selector, e.g. of a [[SpeakableSpecification]] or [[WebPageElement]]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".';
    public const LABEL = 'cssSelector';
    public const NAME = 'schema:cssSelector';
    public const VALUES = ['CssSelectorTypeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CssSelectorTypeModel'];
    public const TYPES = ['SpeakableSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpeakableSpecificationModel', 'WebPageElement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\WebPageElementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1389'];
    public const SUPERSEDED_BY = null;
}
