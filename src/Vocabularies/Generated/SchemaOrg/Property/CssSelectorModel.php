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

final class CssSelectorModel
{
    public const DESCRIPTION = 'A CSS selector, e.g. of a [[SpeakableSpecification]] or [[WebPageElement]]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".';
    public const LABEL = 'cssSelector';
    public const NAME = 'schema:cssSelector';
    public const VALUES = ['CssSelectorTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CssSelectorTypeModel'];
    public const TYPES = ['SpeakableSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\SpeakableSpecificationModel', 'WebPageElement' => 'Jolicode\Vocabularies\SchemaOrg\Type\WebPageElementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
