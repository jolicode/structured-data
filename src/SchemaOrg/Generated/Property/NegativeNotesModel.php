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

final class NegativeNotesModel
{
    public const DESCRIPTION = 'Provides negative considerations regarding something, most typically in pro/con lists for reviews (alongside [[positiveNotes]]). For symmetry 

In the case of a [[Review]], the property describes the [[itemReviewed]] from the perspective of the review; in the case of a [[Product]], the product itself is being described. Since product descriptions 
tend to emphasise positive claims, it may be relatively unusual to find [[negativeNotes]] used in this way. Nevertheless for the sake of symmetry, [[negativeNotes]] can be used on [[Product]].

The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most negative is at the beginning of the list).';
    public const LABEL = 'negativeNotes';
    public const NAME = 'schema:negativeNotes';
    public const VALUES = ['ItemListModel' => 'Jolicode\SchemaOrg\Type\ItemListModel', 'ListItemModel' => 'Jolicode\SchemaOrg\Type\ListItemModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Review' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
