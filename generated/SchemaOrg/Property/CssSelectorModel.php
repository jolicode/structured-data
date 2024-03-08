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

final class CssSelectorModel
{
    public const DESCRIPTION = 'A CSS selector, e.g. of a [[SpeakableSpecification]] or [[WebPageElement]]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".';
    public const LABEL = 'cssSelector';
    public const NAME = 'schema:cssSelector';
    public const VALUES = ['CssSelectorTypeModel' => 'SchemaOrg\Type\CssSelectorTypeModel'];
    public const TYPES = ['SpeakableSpecification' => 'SchemaOrg\Type\SpeakableSpecificationModel', 'WebPageElement' => 'SchemaOrg\Type\WebPageElementModel'];
}
