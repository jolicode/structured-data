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

final class SuggestedAnswerModel
{
    public const DESCRIPTION = 'An answer (possibly one of several, possibly incorrect) to a Question, e.g. on a Question/Answer site.';
    public const LABEL = 'suggestedAnswer';
    public const NAME = 'schema:suggestedAnswer';
    public const VALUES = ['AnswerModel' => 'Jolicode\SchemaOrg\Type\AnswerModel', 'ItemListModel' => 'Jolicode\SchemaOrg\Type\ItemListModel'];
    public const TYPES = ['Question' => 'Jolicode\SchemaOrg\Type\QuestionModel'];
}
