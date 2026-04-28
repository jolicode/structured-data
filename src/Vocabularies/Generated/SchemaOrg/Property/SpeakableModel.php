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

final class SpeakableModel
{
    public const DESCRIPTION = 'Indicates sections of a Web page that are particularly \'speakable\' in the sense of being highlighted as being especially appropriate for text-to-speech conversion. Other sections of a page may also be usefully spoken in particular circumstances; the \'speakable\' property serves to indicate the parts most likely to be generally useful for speech.

The *speakable* property can be repeated an arbitrary number of times, with three kinds of possible \'content-locator\' values:

1.) *id-value* URL references - uses *id-value* of an element in the page being annotated. The simplest use of *speakable* has (potentially relative) URL values, referencing identified sections of the document concerned.

2.) CSS Selectors - addresses content in the annotated page, e.g. via class attribute. Use the [[cssSelector]] property.

3.)  XPaths - addresses content via XPaths (assuming an XML view of the content). Use the [[xpath]] property.


For more sophisticated markup of speakable sections beyond simple ID references, either CSS selectors or XPath expressions to pick out document section(s) as speakable. For this
we define a supporting type, [[SpeakableSpecification]]  which is defined to be a possible value of the *speakable* property.';
    public const LABEL = 'speakable';
    public const NAME = 'schema:speakable';
    public const VALUES = ['SpeakableSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SpeakableSpecificationModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Article' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArticleModel', 'WebPage' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\WebPageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
