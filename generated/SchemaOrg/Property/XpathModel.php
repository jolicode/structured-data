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

final class XpathModel
{
    public const DESCRIPTION = 'An XPath, e.g. of a [[SpeakableSpecification]] or [[WebPageElement]]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".';
    public const LABEL = 'xpath';
    public const NAME = 'schema:xpath';
    public const VALUES = ['XPathTypeModel' => 'SchemaOrg\Type\XPathTypeModel'];
    public const TYPES = ['SpeakableSpecification' => 'SchemaOrg\Type\SpeakableSpecificationModel', 'WebPageElement' => 'SchemaOrg\Type\WebPageElementModel'];
}
